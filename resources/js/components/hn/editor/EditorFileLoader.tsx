import { useEditorStore } from '@/states/editorState';
import { useEffect } from 'react';

type EditorFileLoaderProps = {
  imgSource: string;
};

export default function EditorFileLoader({ imgSource }: EditorFileLoaderProps) {
  const setInitialState = useEditorStore((state) => state.setInitialState);

  useEffect(() => {
    const img = new Image();
    img.crossOrigin = 'anonymous';

    const handleLoad = () => setInitialState(img, img.width, img.height);

    img.addEventListener('load', handleLoad);
    img.src = imgSource;

    return () => {
      img.removeEventListener('load', handleLoad);
    };
  }, [imgSource, setInitialState]);

  return (
    <div className="flex h-full min-h-[40vh] flex-1 flex-col items-center justify-center">
      <div className="loading loading-lg" />
    </div>
  );
}
