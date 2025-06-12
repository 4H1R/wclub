/* eslint-disable @typescript-eslint/no-unused-vars */
import { useCallback, useEffect, useRef } from 'react';
import { toast } from 'react-toastify';
import { IText } from './Editor';

interface IProps {
  width: number;
  height: number;
  radius: number;
  canvasWidth: number;
  canvasHeight: number;

  backgroundColor: string | CanvasGradient | CanvasPattern;

  mainImage: HTMLImageElement;

  logoImage?: HTMLImageElement;
  logoPosition: '7' | '9' | '3' | '1';
  logoWidth: number;
  logoHeight: number;

  text: IText;
  textAuthor: IText;
  textCaption: IText;
  allow: boolean;
  setFinal: (img: HTMLImageElement) => void;
}

function EditorCanvas({
  width,
  height,
  radius,
  canvasWidth,
  canvasHeight,
  backgroundColor,
  mainImage,
  logoImage,
  logoPosition,
  logoWidth,
  logoHeight,
  text: textMain,
  textAuthor,
  textCaption,
  allow,
  setFinal,
}: IProps) {
  const refCanvas = useRef<HTMLCanvasElement>(null);
  const refCTX = useRef<CanvasRenderingContext2D | null>(null);
  const download = () => {
    const canvas = refCanvas.current;
    if (!canvas) return;
    const link = document.createElement('a');
    link.download = 'image.png';
    link.href = canvas.toDataURL();
    link.click();
  };

  useEffect(() => {
    const canvas: HTMLCanvasElement | null = refCanvas.current;
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    if (ctx) {
      refCTX.current = ctx;
      render();
    }
  }, []);
  const save = () => {
    const canvas = refCanvas.current;
    if (!canvas) return;
    const img = new Image();
    img.addEventListener('load', () => {
      setFinal(img);
      render();
    });
    img.src = canvas.toDataURL();
  };

  const render = useCallback(() => {
    const canvas = refCanvas.current;
    const ctx = refCTX.current;

    if (!canvas || !ctx) return;

    // Clear canvas
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;

    const acpectRatio = Math.max(canvasWidth, canvasHeight) / Math.min(canvasWidth, canvasHeight);
    canvas.style.aspectRatio = `1 / ${acpectRatio}`;

    // Paint the background
    ctx.fillStyle = backgroundColor ?? '#da6173';
    ctx.fillRect(0, 0, canvasWidth, canvasHeight);

    // Draw image centered
    const cx = canvasWidth / 2;
    const cy = canvasHeight / 2;

    roundedImage(mainImage, ctx, cx - width / 2, cy - height / 2, width, height, radius);

    if (logoImage) {
      const logoPositions: {
        '7': { x: number; y: number };
        '9': { x: number; y: number };
        '1': { x: number; y: number };
        '3': { x: number; y: number };
      } = {
        '7': { x: 0, y: 0 },
        '9': { x: canvasWidth - logoWidth, y: 0 },
        '1': { x: 0, y: canvasHeight - logoHeight },
        '3': {
          x: canvasWidth - logoWidth,
          y: canvasHeight - logoHeight,
        },
      };
      roundedImage(
        logoImage,
        ctx,
        logoPositions[logoPosition].x,
        logoPositions[logoPosition].y,
        logoWidth,
        logoHeight,
        2,
      );
    }

    const txt = text(
      textMain.text,
      ctx,
      cx,
      cy,
      textMain.textSize,
      textMain.textColor,
      textMain.textAlign,
      textMain.textVAlign,
      textMain.textFont,
    );
    const author = text(
      textAuthor.text,
      ctx,
      cx,
      canvasHeight,
      textAuthor.textSize,
      textAuthor.textColor,
      textAuthor.textAlign,
      'end',
      textAuthor.textFont,
    );
    const caption = text(
      textCaption.text,
      ctx,
      cx,
      canvasHeight - author,
      textCaption.textSize,
      textCaption.textColor,
      textCaption.textAlign,
      'end',
      textCaption.textFont,
      96,
    );
  }, [
    width,
    height,
    radius,
    canvasWidth,
    canvasHeight,
    backgroundColor,
    mainImage,
    logoImage,
    logoPosition,
    logoWidth,
    logoHeight,
    textMain,
    textAuthor,
    textCaption,
  ]);

  function text(
    text: string,
    ctx: CanvasRenderingContext2D,
    x: number,
    y: number,
    textSize: number,
    textColor: string,
    textAlign: CanvasTextAlign,
    textVAlign: CanvasTextAlign,
    textFont: string,
    margin: number = 0, // Single margin value for both top and bottom
  ): number {
    // Return the height of the rendered text
    // ctx.shadowBlur = 5;
    ctx.shadowColor = 'black';
    // ctx.shadowOffsetX = 5;
    // ctx.shadowOffsetY = 5;

    ctx.font = `bold ${textSize}px ${textFont}`;
    ctx.fillStyle = textColor ?? 'white';
    ctx.textAlign = textAlign;

    const words = text.split(' ');
    const lines: string[] = [];
    let currentLine = '';

    // Wrap text based on the canvas width (canvasWidth)
    words.forEach((word) => {
      const testLine = currentLine ? currentLine + ' ' + word : word;
      const testWidth = ctx.measureText(testLine).width;

      if (testWidth > canvasWidth && currentLine.length > 0) {
        lines.push(currentLine);
        currentLine = word; // Start a new line with the current word
      } else {
        currentLine = testLine;
      }
    });
    lines.push(currentLine); // Add the last line

    // Adjust the vertical positioning based on textVAlign
    if (textVAlign === 'start') {
      y += margin; // Apply margin to the initial y position (top margin)
      lines.forEach((l, i) => {
        ctx.fillText(l, x, y + textSize * i, canvasWidth);
      });
    } else if (textVAlign === 'end') {
      y -= textSize * lines.length;
      y -= margin; // Apply margin after the last line (bottom margin)
      lines.forEach((l, i) => {
        ctx.fillText(l, x, y + textSize * i, canvasWidth);
      });
    } else {
      // Center vertically
      y -= (textSize * lines.length) / 2;
      y += margin; // Apply top margin before centering
      lines.forEach((l, i) => {
        ctx.fillText(l, x, y + textSize * i, canvasWidth);
      });
    }

    ctx.shadowOffsetX = 0;
    ctx.shadowOffsetY = 0;
    ctx.shadowBlur = 0;

    // Return the height of the rendered text including the top and bottom margin
    return textSize * lines.length + margin * 2; // Adding margin to the total height
  }

  function roundedImage(
    p: HTMLImageElement,
    ctx: CanvasRenderingContext2D,
    x: number,
    y: number,
    width: number,
    height: number,
    radius: number,
  ) {
    ctx.save();
    const shortestEdge = Math.min(height, width) / 2;
    radius = shortestEdge * (Math.min(radius, 100) / 100);
    ctx.beginPath();
    ctx.moveTo(x + radius, y);
    ctx.lineTo(x + width - radius, y);
    ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
    ctx.lineTo(x + width, y + height - radius);
    ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
    ctx.lineTo(x + radius, y + height);
    ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
    ctx.lineTo(x, y + radius);
    ctx.quadraticCurveTo(x, y, x + radius, y);
    ctx.closePath();
    ctx.clip();
    ctx.drawImage(p, x, y, width, height);
    ctx.restore();
  }

  useEffect(() => {
    render();
    document.fonts.ready.then(render);
  }, [render]);

  return (
    <div className="flex w-full flex-col items-center justify-center sm:h-full">
      <canvas
        ref={refCanvas}
        className="h-auto w-full sm:w-[512px] sm:rounded-lg"
        width={canvasWidth}
        height={canvasHeight}
      />
      <div className="mt-4 flex items-center justify-center gap-5">
        <button
          onClick={allow ? save : () => {}}
          className="btn btn-primary bottom-0 left-0 right-0 m-auto mb-2 text-white"
        >
          <svg
            width="24"
            height="24"
            fill="none"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M17.75 3A3.25 3.25 0 0 1 21 6.25v11.5A3.25 3.25 0 0 1 17.75 21H6.25A3.25 3.25 0 0 1 3 17.75V6.25A3.25 3.25 0 0 1 6.25 3h11.5Zm.58 16.401-5.805-5.686a.75.75 0 0 0-.966-.071l-.084.07-5.807 5.687c.182.064.378.099.582.099h11.5c.203 0 .399-.035.58-.099l-5.805-5.686L18.33 19.4ZM17.75 4.5H6.25A1.75 1.75 0 0 0 4.5 6.25v11.5c0 .208.036.408.103.594l5.823-5.701a2.25 2.25 0 0 1 3.02-.116l.128.116 5.822 5.702c.067-.186.104-.386.104-.595V6.25a1.75 1.75 0 0 0-1.75-1.75Zm-2.498 2a2.252 2.252 0 1 1 0 4.504 2.252 2.252 0 0 1 0-4.504Zm0 1.5a.752.752 0 1 0 0 1.504.752.752 0 0 0 0-1.504Z"
              fill="currentColor"
            />
          </svg>
          {allow ? 'نمایش نمونه' : 'مجاز به نهایی سازی نیستید'}
        </button>

        <button
          onClick={allow ? download : () => {}}
          className="btn btn-primary bottom-0 left-0 right-0 m-auto mb-2 border-slate-950 bg-slate-700 text-white"
        >
          <svg
            width="24"
            height="24"
            fill="none"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M6.087 7.75a5.752 5.752 0 0 1 11.326 0h.087a4 4 0 0 1 3.962 4.552 6.534 6.534 0 0 0-1.597-1.364A2.501 2.501 0 0 0 17.5 9.25h-.756a.75.75 0 0 1-.75-.713 4.25 4.25 0 0 0-8.489 0 .75.75 0 0 1-.749.713H6a2.5 2.5 0 0 0 0 5h4.4a6.458 6.458 0 0 0-.357 1.5H6a4 4 0 0 1 0-8h.087ZM22 16.5a5.5 5.5 0 1 0-11 0 5.5 5.5 0 0 0 11 0Zm-6-3a.5.5 0 0 1 1 0v4.793l1.646-1.647a.5.5 0 0 1 .708.708l-2.5 2.5a.5.5 0 0 1-.708 0l-2.5-2.5a.5.5 0 0 1 .708-.708L16 18.293V13.5Z"
              fill="#ffffff"
            />
          </svg>
          {allow ? 'بارگیری برای استفاده' : 'مجاز به نهایی سازی نیستید'}
        </button>
      </div>
    </div>
  );
}

export default EditorCanvas;
