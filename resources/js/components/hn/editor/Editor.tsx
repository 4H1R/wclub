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
  const [finalImage, setFinalImage] = useState<HTMLImageElement>();
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const img = useEditorStore((state) => state.img);

  const handleSave = () => {
    const canvas = canvasRef.current;
    if (!canvas) return;

    const img = new Image();
    img.addEventListener('load', () => setFinalImage(img));
    img.src = canvas.toDataURL();
  };

  const handleDownload = () => {
    const canvas = canvasRef.current;
    if (!canvas) return;
    const link = document.createElement('a');
    link.download = 'image.png';
    link.href = canvas.toDataURL();
    link.click();
  };

  const handleNext = () => {
    if (step === 2) handleSave();
    setStep(step + 1);
  };

  if (!img) return <EditorFileLoader imgSource={imgSource} />;

  return (
    <>
      <Container>
        {step !== 3 && <EditorSidebar />}
        <EditorCanvas canvasRef={canvasRef} />
        {step === 3 && finalImage && <Gallery userImage={finalImage} />}
      </Container>
      <div className="flex items-center justify-between gap-4">
        <Button onClick={() => setStep(step - 1)} className="btn">
          مرحله قبل
        </Button>
        <Button onClick={step === 3 ? handleDownload : handleNext} className="btn btn-primary">
          {step === 3 ? 'دانلود خروجی نهایی' : 'مرحله بعد'}
        </Button>
      </div>
    </>
  );
}
