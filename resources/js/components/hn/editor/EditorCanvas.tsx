import { useEditorStore } from '@/states/editorState';
import { memo, useCallback, useEffect, useRef } from 'react';
import { useShallow } from 'zustand/shallow';

type EditorCanvasProps = {
  canvasRef: React.RefObject<HTMLCanvasElement | null>;
};

function EditorCanvas({ canvasRef }: EditorCanvasProps) {
  const CTXRef = useRef<CanvasRenderingContext2D | null>(null);

  const {
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
  } = useEditorStore(
    useShallow((state) => ({
      width: state.width,
      height: state.height,
      radius: state.radius,
      canvasWidth: state.canvasWidth,
      canvasHeight: state.canvasHeight,
      backgroundColor: state.bg,
      mainImage: state.img,
      logoImage: state.logo,
      logoPosition: state.logoPosition,
      logoWidth: state.logoWidth,
      logoHeight: state.logoHeight,
      textMain: state.textMain,
      textAuthor: state.textAuthor,
      textCaption: state.textCaption,
    })),
  );

  useEffect(() => {
    const canvas: HTMLCanvasElement | null = canvasRef.current;
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    if (ctx) {
      CTXRef.current = ctx;
      render();
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  const render = useCallback(() => {
    const canvas = canvasRef.current;
    const ctx = CTXRef.current;

    if (!canvas || !ctx || !mainImage) return;

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

    text(
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
    text(
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
    canvasRef,
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
    if (!text || text.length === 0) return 0;

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
    <div className="flex w-full flex-col items-center justify-center gap-8 sm:h-full">
      <canvas
        ref={canvasRef}
        className="h-auto w-full sm:w-[512px] sm:rounded-lg"
        width={canvasWidth}
        height={canvasHeight}
      />
    </div>
  );
}

export default memo(EditorCanvas);
