/* eslint-disable @typescript-eslint/no-unused-vars */
import { useCallback, useEffect, useRef, useState } from 'react';
import { HiOutlineArrowDownTray } from 'react-icons/hi2';
import { IFrame } from './Gallery';

interface IProps {
  userImage: HTMLImageElement;
  source: IFrame;
  setFinal: (img: Blob) => void;
}

export default function GalleryCanvas({ userImage, source, setFinal }: IProps) {
  const refCanvas = useRef<HTMLCanvasElement>(null);
  const refCTX = useRef<CanvasRenderingContext2D | null>(null);
  const [img, setImg] = useState<HTMLImageElement>();

  const handleSave = () => {
    const canvas = refCanvas.current;
    if (!canvas) return;
    canvas.toBlob((blob) => blob && setFinal(blob));
  };

  const handleDownload = () => {
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
    refCTX.current = ctx;
    const img = new Image();
    img.addEventListener('load', () => {
      setImg(img);
    });
    img.src = source.url;
  }, [source.url]);

  const render = useCallback(() => {
    const canvas = refCanvas.current;
    const ctx = refCTX.current;

    if (!canvas || !ctx || !img) return;

    // Clear canvas
    canvas.width = img.width;
    canvas.height = img.height;

    const acpectRatio = Math.max(img.width, img.height) / Math.min(img.width, img.height);
    canvas.style.aspectRatio = `1 / ${acpectRatio}`;

    roundedImage(img, ctx, 0, 0, img.width, img.height, 0);
    const shadowData = getShadows(ctx);

    source.frames.forEach((frame) => {
      maskShadow(
        shadowData,
        userImage,
        ctx,
        frame.x,
        frame.y,
        frame.w,
        frame.h,
        frame.r,
        frame.blend,
      );
    });
  }, [img, source, userImage]);

  const roundedImage = (
    p: HTMLImageElement,
    ctx: CanvasRenderingContext2D,
    x: number,
    y: number,
    width: number,
    height: number,
    radius: number,
  ) => {
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
  };
  const maskShadow = (
    shadow: HTMLCanvasElement,
    picture: HTMLImageElement,
    ctx: CanvasRenderingContext2D,
    x: number,
    y: number,
    width: number,
    height: number,
    radius: number,
    blend: number,
  ) => {
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

    // Calculate the aspect ratio of the image and the box
    const imgAspectRatio = picture.width / picture.height;
    const boxAspectRatio = width / height;

    let drawWidth, drawHeight, offsetX, offsetY;

    // Determine how to fill the box while maintaining the aspect ratio
    if (imgAspectRatio > boxAspectRatio) {
      // Image is wider than the box (fit to height, crop sides)
      drawHeight = height;
      drawWidth = height * imgAspectRatio;
      offsetX = x - (drawWidth - width) / 2; // Center horizontally
      offsetY = y;
    } else {
      // Image is taller than the box (fit to width, crop top/bottom)
      drawWidth = width;
      drawHeight = width / imgAspectRatio;
      offsetX = x;
      offsetY = y - (drawHeight - height) / 2; // Center vertically
    }

    // Draw the image with the "cover" effect (filling the box while maintaining aspect ratio)
    ctx.drawImage(picture, offsetX, offsetY, drawWidth, drawHeight);

    ctx.globalAlpha = blend;
    ctx.drawImage(shadow, 0, 0, ctx.canvas.width, ctx.canvas.height);
    ctx.globalAlpha = 1;
    ctx.restore();
  };

  const getShadows = (ctx: CanvasRenderingContext2D) => {
    const imgData = ctx.getImageData(0, 0, ctx.canvas.width, ctx.canvas.height);
    for (let i = 0; i < imgData.data.length; i += 4) {
      const r = imgData.data[i] / 255;
      const g = imgData.data[i + 1] / 255;
      const b = imgData.data[i + 2] / 255;

      const max = Math.max(r, g, b);
      const min = Math.min(r, g, b);
      const l = (max + min) / 2;

      const alpha = 1 - l;

      // Set the black color (0, 0, 0) and lightness as the alpha channel
      imgData.data[i] = 0; // Red
      imgData.data[i + 1] = 0; // Green
      imgData.data[i + 2] = 0; // Blue
      imgData.data[i + 3] = alpha * 255; // Alpha channel based on lightness
    }
    const canvas = document.createElement('canvas');

    canvas.width = ctx.canvas.width;
    canvas.height = ctx.canvas.height;
    canvas.getContext('2d')?.putImageData(imgData, 0, 0);

    return canvas;
  };
  useEffect(() => {
    render();
  }, [render]);

  return (
    <div className="flex flex-col">
      <canvas
        ref={refCanvas}
        className="h-auto w-full shadow-xl sm:w-[512px] sm:rounded-lg"
        width={img?.width}
        height={img?.height}
      ></canvas>
      <div className="mx-auto mt-4 flex items-center gap-4">
        {/* <button onClick={save} disabled={!allow} className="btn">
          {allow ? 'نهایی سازی تغییرات' : 'مجاز به نهایی سازی نیستید'}
        </button> */}
        <button onClick={handleDownload} className="btn btn-outline">
          <HiOutlineArrowDownTray />
          <span>دانلود</span>
        </button>
      </div>
    </div>
  );
}
