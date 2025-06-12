import { Head } from '@inertiajs/react';
import { useState } from 'react';
import EditorCanvas from './EditorCanvas';
import EditorFilePicker from './EditorFilePicker';
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
interface IProps {
  imgSource: string;
  setFinal: (img: Blob) => void;
  allow: boolean;
}

function Editor({ imgSource, setFinal, allow }: IProps) {
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

  const [canvasWidth, setCanvasWidth] = useState<number>(8.25 * 150);
  const [canvasHeight, setCanvasHeight] = useState<number>(11.75 * 150);
  const [canvasDPI, setCanvasDPI] = useState<number>(150);

  const [radius, setRadius] = useState<number>(50);

  return (
    <div className="flex h-max w-full flex-wrap items-center justify-center gap-4 lg:flex-nowrap">
      <Head>
        <link
          href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;700;900&family=Lalezar&family=Noto+Nastaliq+Urdu:wght@400&display=swap"
          rel="stylesheet"
        />
      </Head>
      {onImage ? (
        <Gallery userImage={onImage} setFinal={setFinal} allow={allow} />
      ) : img ? (
        <>
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
          <EditorCanvas
            setFinal={setOnImage}
            allow={allow}
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
          />
        </>
      ) : (
        <EditorFilePicker
          default={imgSource}
          setImage={setImage}
          setWidth={setWidth}
          setHeigth={setHeight}
        />
      )}
    </div>
  );
}

export default Editor;
