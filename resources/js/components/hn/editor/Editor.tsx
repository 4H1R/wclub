import Button from '@/shared/forms/Button';
import { useRef, useState } from 'react';
import Container from './Container';
import EditorCanvas from './EditorCanvas';
import EditorFileLoader from './EditorFileLoader';
import EditorSidebar from './EditorSidebar';
import Gallery from './Gallery';

export interface IText {
  text: string;
  textSize: number;
  textFont: string;
  textColor: string;
  textAlign: CanvasTextAlign;
  textVAlign: CanvasTextAlign;
}

export interface ITextSetters {
  setText: (text: string) => void;
  setTextSize: (size: number) => void;
  setTextFont: (font: string) => void;
  setTextColor: (color: string) => void;
  setTextAlign: (align: CanvasTextAlign) => void;
  setTextVAlign: (valign: CanvasTextAlign) => void;
}

export type ITextState = IText & ITextSetters;

const useText = (): ITextState => {
  const [text, setText] = useState<string>('');
  const [textSize, setTextSize] = useState<number>(24);
  const [textFont, setTextFont] = useState<string>('Lalezar');
  const [textColor, setTextColor] = useState<string>('#da6173');
  const [textAlign, setTextAlign] = useState<CanvasTextAlign>('center');
  const [textVAlign, setTextVAlign] = useState<CanvasTextAlign>('center');
  return {
    text,
    setText,
    textSize,
    setTextSize,
    textFont,
    setTextFont,
    textColor,
    setTextColor,
    textAlign,
    setTextAlign,
    textVAlign,
    setTextVAlign,
  };
};

type EditorProps = {
  imgSource: string;
  step: number;
  setStep: React.Dispatch<React.SetStateAction<number>>;
};

export default function Editor({ imgSource, step, setStep }: EditorProps) {
  const [onImage, setOnImage] = useState<HTMLImageElement>();

  const [bg, setBg] = useState<string>('#ffffff');
  const [img, setImage] = useState<HTMLImageElement>();
  const [logo, setLogo] = useState<HTMLImageElement>();
  const [logoPosition, setLogoPosition] = useState<'7' | '9' | '1' | '3'>('7');
  const [logoWidth, setLogoWidth] = useState<number>(50);
  const [logoHeight, setLogoHeight] = useState<number>(50);

  const textMain = useText();
  const textAuthor = useText();
  const textCaption = useText();

  const [width, setWidth] = useState<number>(0);
  const [height, setHeight] = useState<number>(0);

  const canvasRef = useRef<HTMLCanvasElement>(null);
  const [canvasWidth, setCanvasWidth] = useState<number>(8.25 * 150);
  const [canvasHeight, setCanvasHeight] = useState<number>(11.75 * 150);
  const [canvasDPI, setCanvasDPI] = useState<number>(150);

  const [radius, setRadius] = useState<number>(50);

  const handleDownload = () => {
    const canvas = canvasRef.current;
    if (!canvas) return;
    const link = document.createElement('a');
    link.download = 'image.png';
    link.href = canvas.toDataURL();
    link.click();
  };

  if (!img) {
    return (
      <EditorFileLoader
        default={imgSource}
        setImage={setImage}
        setWidth={setWidth}
        setHeight={setHeight}
      />
    );
  }

  return (
    <>
      <Container>
        {step !== 3 && (
          <EditorSidebar
            defaults={{
              width: width,
              height: height,
              canvasWidth: canvasWidth,
              canvasHeight: canvasHeight,
              img: img,
              dpi: canvasDPI,
              radius: radius,
              bg: bg,
            }}
            textMain={textMain}
            textAuthor={textAuthor}
            textCaption={textCaption}
            setWidth={setWidth}
            setHeight={setHeight}
            setCanvasWidth={setCanvasWidth}
            setCanvasHeight={setCanvasHeight}
            setCanvasDPI={setCanvasDPI}
            setImage={setImage}
            setRadius={setRadius}
            setBg={setBg}
            setLogo={setLogo}
            setLogoWidth={setLogoWidth}
            setLogoHeight={setLogoHeight}
            setLogoPosition={setLogoPosition}
          />
        )}
        <EditorCanvas
          setFinal={setOnImage}
          logoImage={logo}
          logoHeight={logoHeight}
          logoWidth={logoWidth}
          logoPosition={logoPosition}
          backgroundColor={bg}
          canvasWidth={canvasWidth}
          canvasHeight={canvasHeight}
          width={width}
          height={height}
          mainImage={img}
          text={textMain}
          textAuthor={textAuthor}
          textCaption={textCaption}
          radius={radius}
          canvasRef={canvasRef}
        />
        {step === 3 && onImage && <Gallery userImage={onImage} setFinal={() => {}} />}
      </Container>
      <div className="flex items-center justify-between gap-4">
        <Button onClick={() => setStep(step - 1)} className="btn">
          مرحله قبل
        </Button>
        <Button
          onClick={step === 3 ? handleDownload : () => setStep(step + 1)}
          className="btn btn-primary"
        >
          {step === 3 ? 'دانلود خروجی نهایی' : 'مرحله بعد'}
        </Button>
      </div>
    </>
  );
}
