import Button from '@/shared/forms/Button';
import { useEditorStore } from '@/states/editorState';
import { useRef, useState } from 'react';
import Container from './Container';
import EditorCanvas from './EditorCanvas';
import EditorFileLoader from './EditorFileLoader';
import EditorSidebar from './EditorSidebar';
import Gallery from './Gallery';

type EditorProps = {
  imgSource: string;
  step: number;
  setStep: React.Dispatch<React.SetStateAction<number>>;
};

export default function Editor({ imgSource, step, setStep }: EditorProps) {
  const [onImage, setOnImage] = useState<HTMLImageElement>();
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const img = useEditorStore((state) => state.img);

  const handleDownload = () => {
    const canvas = canvasRef.current;
    if (!canvas) return;
    const link = document.createElement('a');
    link.download = 'image.png';
    link.href = canvas.toDataURL();
    link.click();
  };

  if (!img) return <EditorFileLoader imgSource={imgSource} />;

  return (
    <>
      <Container>
        {step !== 3 && <EditorSidebar />}
        <EditorCanvas setFinal={setOnImage} canvasRef={canvasRef} />
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
