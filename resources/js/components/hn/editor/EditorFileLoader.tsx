import { useEffect } from 'react';

type EditorFileLoaderProps = {
  setImage: (img: HTMLImageElement) => void;
  setWidth: (width: number) => void;
  setHeight: (height: number) => void;
  default: string;
};

export default function EditorFileLoader({
  setImage,
  setWidth,
  setHeight,
  default: defaultSrc,
}: EditorFileLoaderProps) {
  useEffect(() => {
    const img = new Image();
    img.crossOrigin = 'anonymous';

    const handleLoad = () => {
      setImage(img);
      setWidth(img.width);
      setHeight(img.height);
    };

    img.addEventListener('load', handleLoad);
    img.src = defaultSrc;

    return () => {
      img.removeEventListener('load', handleLoad);
    };
  }, [defaultSrc, setImage, setWidth, setHeight]);

  return (
    <div className="flex h-full min-h-[40vh] flex-1 flex-col items-center justify-center">
      <div className="loading loading-lg" />
    </div>
  );
}
