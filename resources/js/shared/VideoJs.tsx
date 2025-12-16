import { useEffect, useRef } from 'react';
import videojs from 'video.js';
import Player from 'video.js/dist/types/player';
import 'video.js/dist/video-js.css';

export type VideoJsProps = {
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  options: any;
  onReady?: () => void;
  onEnded?: () => void;
  onPlay?: () => void;
  onPause?: () => void;
  startTime?: number;
  onLastSecondLazy?: (seconds: number) => void;
  className?: string;
};

export default function VideoJS({
  options,
  onEnded,
  onPlay,
  onPause,
  onLastSecondLazy,
  onReady,
  startTime,
  className,
}: VideoJsProps) {
  const videoRef = useRef<HTMLDivElement>(null);
  const lastSeconds = useRef<number>(0);
  const playerRef = useRef<Player | null>(null);

  useEffect(() => {
    if (!playerRef.current) {
      const videoElement = document.createElement('video-js');

      videoElement.classList.add('vjs-big-play-centered');
      videoRef.current?.appendChild(videoElement);

      playerRef.current = videojs(videoElement, options, () => {
        if (onReady) onReady();
      });
    } else {
      const player = playerRef.current;

      if (onEnded) player.on('ended', onEnded);
      if (onPlay) player.on('play', onPlay);
      if (onPause) player.on('pause', onPause);
      player.currentTime(startTime);
      player.autoplay(options.autoplay);
      player.src(options.sources);
    }
  }, [options, videoRef]);

  useEffect(() => {
    const player = playerRef.current;

    const interval = setInterval(() => {
      if (!onLastSecondLazy || !player) return;
      const currentSeconds = Math.round(player.currentTime() ?? 0);
      if (currentSeconds === 0 || lastSeconds.current === currentSeconds) return;
      onLastSecondLazy(currentSeconds);
      lastSeconds.current = currentSeconds;
    }, 20_000);

    return () => {
      clearInterval(interval);
      if (player && !player.isDisposed()) {
        playerRef.current?.dispose();
        playerRef.current = null;
      }
    };
  }, [playerRef]);

  return (
    <div data-vjs-player className={className}>
      <div ref={videoRef} />
    </div>
  );
}
