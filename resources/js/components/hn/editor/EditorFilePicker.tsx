import { useEffect } from 'react';

interface IProps {
  setImage: (img: HTMLImageElement) => void;
  setWidth: (width: number) => void;
  setHeigth: (height: number) => void;
  default: string;
}

export default function EditorFilePicker({
  setImage,
  setWidth,
  setHeigth,
  default: defaultSrc,
}: IProps) {
  useEffect(() => {
    const img = new Image();
    img.crossOrigin = 'anonymous';

    const handleLoad = () => {
      setImage(img);
      setWidth(img.width);
      setHeigth(img.height);
    };

    img.addEventListener('load', handleLoad);
    img.src = defaultSrc;

    return () => {
      img.removeEventListener('load', handleLoad);
    };
  }, [defaultSrc, setImage, setWidth, setHeigth]);

  return <p>Loading</p>;
}
