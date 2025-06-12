import GalleryCanvas from './GalleryCanvas';

interface IBoundry {
  x: number;
  y: number;
  w: number;
  h: number;
  r: number;
  blend: number;
}

export interface IFrame {
  url: string;
  frames: IBoundry[];
}

interface IProps {
  userImage: HTMLImageElement;
  allow: boolean;
  setFinal: (img: Blob) => void;
}

function Gallery({ userImage, allow, setFinal }: IProps) {
  const sources: IFrame[] = [
    {
      url: '/images/hn/back/mug.webp',
      frames: [{ x: 280, y: 358, w: 356, h: 450, r: 2, blend: 1 }],
    },
    {
      url: '/images/hn/back/shirt.webp',
      frames: [{ x: 278, y: 235, w: 502, h: 656, r: 2, blend: 1 }],
    },
    {
      url: '/images/hn/back/pinback.webp',
      frames: [{ x: 472, y: 472, w: 875, h: 875, r: 437.5, blend: 1 }],
    },
  ];

  return (
    <div className="flex flex-col items-center justify-center gap-10 p-10">
      {sources.map((s, i) => (
        <GalleryCanvas key={i} source={s} userImage={userImage} allow={allow} setFinal={setFinal} />
      ))}
    </div>
  );
}

export default Gallery;
