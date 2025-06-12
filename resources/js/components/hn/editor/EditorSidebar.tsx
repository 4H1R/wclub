/* eslint-disable @typescript-eslint/no-unused-vars */
/* eslint-disable @typescript-eslint/no-explicit-any */
import { ChangeEvent, useState } from 'react';
// import * as tf from '@tensorflow/tfjs';
import { ITextState } from './Editor';
import MultiInput from './MultiInput';

// const worker = new Worker('/build/workers.js');

interface IProps {
  defaults: {
    width: number;
    height: number;
    canvasWidth: number;
    canvasHeight: number;
    dpi: number;
    img: HTMLImageElement;
    radius: number;
    bg: string;
  };
  setImage: (img: HTMLImageElement) => void;
  textMain: ITextState;
  textCaption: ITextState;
  textAuthor: ITextState;
  setWidth: (width: number) => void;
  setHeight: (height: number) => void;
  setCanvasWidth: (width: number) => void;
  setCanvasHeight: (height: number) => void;
  setCanvasDPI: (dpi: number) => void;
  setRadius: (radius: number) => void;
  setBg: (color: string) => void;
  setLogo: (img: HTMLImageElement) => void;
  setLogoWidth: (width: number) => void;
  setLogoHeight: (height: number) => void;
  setLogoPosition: (position: any) => void;
}

function EditorSidebar({
  defaults,
  textMain,
  textCaption,
  textAuthor,
  setWidth,
  setHeight,
  setCanvasWidth,
  setCanvasHeight,
  setCanvasDPI,
  setRadius,
  setBg,
  setImage,
  setLogo,
  setLogoWidth,
  setLogoHeight,
  setLogoPosition,
}: IProps) {
  const [sizeSelected, setSelectedSize] = useState<number>(0);
  const [upscaling, setUpscaling] = useState<boolean>(false);
  const [model, setModel] = useState<number>(0);
  const [workerState, setWorkerState] = useState<string>('شروع فرایند');
  const sizes: { n: string; w: number; h: number }[] = [
    { n: 'سایز A0', w: 33.125, h: 46.8125 },
    { n: 'سایز A1', w: 23.375, h: 33.125 },
    { n: 'سایز A2', w: 16.5, h: 23.375 },
    { n: 'سایز A3', w: 11.75, h: 16.5 },
    { n: 'سایز A4', w: 8.25, h: 11.75 },
    { n: 'سایز A5 (مناسب تیشرت)', w: 5.875, h: 8.25 },
    { n: 'سایز A6 (مناسب لیوان)', w: 4.125, h: 5.875 },
    { n: 'سایز A7', w: 2.9375, h: 4.125 },
    { n: 'سایز A8', w: 2.0625, h: 2.9375 },
    { n: 'مربع 4x4', w: 1.5748, h: 1.5748 },
    { n: 'مربع 10x10', w: 3.93701, h: 3.93701 },
    { n: 'مربع 40x40', w: 15.748, h: 15.748 },
  ];

  const setToValue = (
    ev: ChangeEvent<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>,
    callback: (value: any) => void,
  ) => {
    let value: any = ev.target.value;
    if (ev.target.type === 'number') {
      value = Number(value);
    }
    callback(value);
  };

  const setSize = (ev: ChangeEvent<HTMLInputElement>, type: 'width' | 'height') => {
    const value = Number(ev.target.value);
    const ratio = defaults.img.width / defaults.img.height;
    if (type === 'width') {
      setWidth(Math.floor(value));
      setHeight(Math.floor(value / ratio));
    } else {
      setHeight(Math.floor(value));
      setWidth(Math.floor(value * ratio));
    }
  };

  const setPaper = (index: number) => {
    const { w, h } = sizes[index];
    setSelectedSize(index);
    const newWidth = w * defaults.dpi;
    const newHeight = h * defaults.dpi;

    setCanvasWidth(newWidth);
    setCanvasHeight(newHeight);

    const scaleX = newWidth / defaults.canvasWidth;
    const scaleY = newHeight / defaults.canvasHeight;

    const scale = Math.min(scaleX, scaleY);

    const imgNewWidth = defaults.width * scale;
    const imgNewHeight = defaults.height * scale;

    setWidth(imgNewWidth);
    setHeight(imgNewHeight);
  };

  const setDPI = (dpi: number) => {
    const { w, h } = sizes[sizeSelected];
    setCanvasDPI(dpi);
    setCanvasWidth(w * dpi);
    setCanvasHeight(h * dpi);
  };

  const createImage = (url: string, callback: CallableFunction) => {
    const img = new Image();

    img.addEventListener('load', () => {
      URL.revokeObjectURL(url);
      callback(img);
    });
    img.crossOrigin = 'anonymous';
    img.src = url;
  };

  const createLogo = (ev: ChangeEvent<HTMLInputElement>) => {
    const file = ev.target?.files?.[0];
    if (!file) return;

    const url = URL.createObjectURL(file);
    createImage(url, setLogo);
  };

  // worker.onmessage = async (
  //   ev: MessageEvent<{
  //     msg: string;
  //     img: [Float32Array | Int32Array | Uint8Array, [number, number, number]];
  //   }>,
  // ) => {
  //   const { msg, img } = ev.data;

  //   if (msg === 'done') {
  //     const [data, shape] = img;

  //     const tensor: tf.Tensor3D = tf.tidy(() => tf.tensor(data, shape).div(255));
  //     const canvas = document.createElement('canvas');

  //     canvas.width = shape[1];
  //     canvas.height = shape[0];

  //     setWorkerState('درحال تبدیل عکس');

  //     tf.browser.toPixels(tensor, canvas).then(() => {
  //       setWidth(shape[1]);
  //       setHeight(shape[0]);
  //       tensor.dispose();
  //       createImage(canvas.toDataURL(), setImage);
  //       setUpscaling(false);
  //     });

  //     return;
  //   }

  //   if (msg === 'error') {
  //     setUpscaling(false);
  //     setWorkerState('شروع فرایند (خطا در فرایند قبل)');
  //     return;
  //   }

  //   setWorkerState(msg); // Update worker state with message
  // };

  // const upscale = async () => {
  //   if (upscaling) return;

  //   const pixels = tf.browser.fromPixels(defaults.img);
  //   await tf.nextFrame();
  //   const data = await pixels.data();

  //   setWorkerState('در حال اماده سازی هوش مصنوعی');

  //   worker.postMessage([data, pixels.shape, model]);
  //   setUpscaling(true);
  // };

  const renderTextInput = (textObj: ITextState, title: string) => (
    <MultiInput
      title={title}
      fields={[
        {
          placeholder: 'اندازه',
          value: textObj.textSize,
          onChange: (ev) => setToValue(ev, textObj.setTextSize),
          type: 'number',
        },
        {
          placeholder: 'رنگ',
          value: textObj.textColor,
          onChange: (ev) => setToValue(ev, textObj.setTextColor),
          type: 'color',
        },
      ]}
      selects={[
        // {
        //   options: [
        //     { value: 'center', label: 'وسط چین' },
        //     { value: 'right', label: 'راست چین' },
        //     { value: 'left', label: 'چپ چین' },
        //   ],
        //   onChange: (ev) => setToValue(ev, textObj.setTextAlign),
        // },
        // {
        //   options: [
        //     { value: 'center', label: 'وسط' },
        //     { value: 'end', label: 'بالا' },
        //     { value: 'start', label: 'پایین' },
        //   ],
        //   onChange: (ev) => setToValue(ev, textObj.setTextVAlign),
        // },
        {
          options: [
            { value: 'Lalezar', label: 'فونت لاله زار' },
            { value: 'Vazirmatn', label: 'فونت وزیر' },
            { value: 'Iran Nastaliq', label: 'فونت نستعلیق' },
            { value: 'Arial', label: 'اریال' },
            { value: 'Calibri', label: 'کالیبری' },
            { value: 'system-ui', label: 'سیستم' },
          ],
          onChange: (ev) => setToValue(ev, textObj.setTextFont),
        },
      ]}
    >
      <textarea
        className="w-full p-3"
        onChange={(ev) => setToValue(ev, textObj.setText)}
        placeholder="نوشته"
        value={textObj.text}
      />
    </MultiInput>
  );

  return (
    <div className="flex w-full max-w-sm flex-col gap-5 text-right sm:max-h-screen sm:overflow-y-scroll">
      <p className="text-xl font-bold">تنظیمات</p>

      <MultiInput
        title="پس زمینه"
        fields={[
          {
            placeholder: 'رنگ',
            value: defaults.bg,
            onChange: (ev) => setToValue(ev, setBg),
            type: 'color',
          },
        ]}
      />
      {/* <MultiInput
        title="افزایش کیفیت"
        fields={[]}
        selects={[
          {
            options: [
              { value: '0', label: 'دو برابر' },
              { value: '1', label: 'سه برابر' },
              { value: '2', label: 'چهار برابر' },
              { value: '3', label: 'هشت برابر' },
            ],
            onChange: (ev) => setToValue(ev, setModel),
          },
        ]}
      >
        <button
          type="button"
          className="inline-flex w-full items-center justify-center rounded-md bg-blue-500 px-4 py-3 text-sm font-semibold text-white shadow transition duration-150 ease-in-out hover:bg-blue-400"
          disabled={upscaling}
          onClick={upscale}
        >
          {upscaling ? (
            <svg
              className="-ml-1 mr-3 h-4 w-4 animate-spin text-white"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            >
              <circle
                className="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                strokeWidth="4"
              ></circle>
              <path
                className="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
              ></path>
            </svg>
          ) : null}
          <span>{workerState}</span>
        </button>
      </MultiInput> */}

      <MultiInput
        title="بوم"
        fields={[
          {
            placeholder: 'کیفیت',
            value: defaults.dpi,
            onChange: (ev) => setDPI(Number(ev.target.value)),
            type: 'number',
          },
        ]}
        selects={[
          {
            options: sizes.map((p, i) => ({ value: i, label: p.n })),
            onChange: (ev) => setPaper(Number(ev.target.value)),
          },
        ]}
      />

      <MultiInput
        title="اندازه تصویر"
        fields={[
          {
            placeholder: 'عرض',
            value: defaults.width,
            onChange: (ev) => setSize(ev, 'width'),
            type: 'number',
          },
          {
            placeholder: 'طول',
            value: defaults.height,
            onChange: (ev) => setSize(ev, 'height'),
            type: 'number',
          },
          {
            placeholder: 'گوشه',
            value: defaults.radius,
            onChange: (ev) => setToValue(ev, setRadius),
            type: 'number',
          },
        ]}
      />

      {renderTextInput(textMain, 'متن دلخواه')}
      {renderTextInput(textCaption, 'متن زیرنویس')}
      {renderTextInput(textAuthor, 'نام نویسنده')}

      <MultiInput
        title="نماد"
        fields={[
          {
            placeholder: 'عرض',
            onChange: (ev) => setToValue(ev, setLogoWidth),
            type: 'number',
          },
          {
            placeholder: 'طول',
            onChange: (ev) => setToValue(ev, setLogoHeight),
            type: 'number',
          },
        ]}
        selects={[
          {
            options: [
              { value: '7', label: 'بالا چپ' },
              { value: '9', label: 'بالا راست' },
              { value: '1', label: 'پایین چپ' },
              { value: '3', label: 'پایین راست' },
            ],
            onChange: (ev) => setLogoPosition(ev.target.value),
          },
        ]}
      >
        <label
          htmlFor="dropzone-file"
          className="w-full cursor-pointer rounded-lg bg-gray-100 hover:hover:bg-blue-700 hover:text-white"
        >
          <div className="flex flex-col items-center justify-center gap-5 p-3">فایل</div>
          <input id="dropzone-file" type="file" className="hidden" onChange={createLogo} />
        </label>
      </MultiInput>
    </div>
  );
}

export default EditorSidebar;
