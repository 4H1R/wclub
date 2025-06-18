/* eslint-disable @typescript-eslint/no-explicit-any */
import { IText, useEditorStore } from '@/states/editorState';
import { ChangeEvent, memo, useCallback, useState } from 'react';
import MultiInput from './MultiInput';

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

function EditorSidebar() {
  const [sizeSelected, setSelectedSize] = useState<number>(0);
  const store = useEditorStore();

  const setSize = useCallback(
    (e: ChangeEvent<HTMLInputElement>, type: 'width' | 'height') => {
      const value = Number(e.target.value);
      const ratio = store.img!.width / store.img!.height;
      if (type === 'width') {
        store.setWidth(Math.floor(value));
        store.setHeight(Math.floor(value / ratio));
      } else {
        store.setHeight(Math.floor(value));
        store.setWidth(Math.floor(value * ratio));
      }
    },
    [store.img, store.setWidth, store.setHeight],
  );

  const setPaper = useCallback(
    (index: number) => {
      const { w, h } = sizes[index];
      setSelectedSize(index);
      const newWidth = w * store.canvasDPI;
      const newHeight = h * store.canvasDPI;

      store.setCanvasWidth(newWidth);
      store.setCanvasHeight(newHeight);

      const scaleX = newWidth / store.canvasWidth;
      const scaleY = newHeight / store.canvasHeight;
      const scale = Math.min(scaleX, scaleY);

      store.setWidth(store.width * scale);
      store.setHeight(store.height * scale);
    },
    [
      store.canvasDPI,
      store.canvasWidth,
      store.canvasHeight,
      store.width,
      store.height,
      store.setCanvasWidth,
      store.setCanvasHeight,
      store.setWidth,
      store.setHeight,
    ],
  );

  const setDPI = useCallback(
    (dpi: number) => {
      const { w, h } = sizes[sizeSelected];
      store.setCanvasDPI(dpi);
      store.setCanvasWidth(w * dpi);
      store.setCanvasHeight(h * dpi);
    },
    [sizeSelected, store.setCanvasDPI, store.setCanvasWidth, store.setCanvasHeight],
  );

  const createImage = useCallback((url: string, callback: CallableFunction) => {
    const img = new Image();

    img.addEventListener('load', () => {
      URL.revokeObjectURL(url);
      callback(img);
    });
    img.crossOrigin = 'anonymous';
    img.src = url;
  }, []);

  const createLogo = useCallback(
    (e: ChangeEvent<HTMLInputElement>) => {
      const file = e.target?.files?.[0];
      if (!file) return;
      const url = URL.createObjectURL(file);
      createImage(url, store.setLogo);
    },
    [createImage, store.setLogo],
  );

  const setText = useEditorStore((state) => state.setText);
  const textMain = useEditorStore((state) => state.textMain);
  const textCaption = useEditorStore((state) => state.textCaption);
  const textAuthor = useEditorStore((state) => state.textAuthor);

  const renderTextInput = useCallback(
    (textObj: IText, title: string, key: 'textMain' | 'textAuthor' | 'textCaption') => (
      <MultiInput
        title={title}
        fields={[
          {
            placeholder: 'اندازه',
            value: textObj.textSize,
            onChange: (e) => setText(key, { textSize: Number(e.target.value) }),
            type: 'number',
          },
          {
            placeholder: 'رنگ',
            value: textObj.textColor,
            onChange: (e) => setText(key, { textColor: e.target.value }),
            type: 'color',
          },
        ]}
        selects={[
          {
            options: [
              { value: 'Lalezar', label: 'فونت لاله زار' },
              { value: 'Vazirmatn', label: 'فونت وزیر' },
              { value: 'Iran Nastaliq', label: 'فونت نستعلیق' },
              { value: 'Arial', label: 'اریال' },
              { value: 'Calibri', label: 'کالیبری' },
              { value: 'system-ui', label: 'سیستم' },
            ],
            onChange: (e) => setText(key, { textFont: e.target.value }),
          },
        ]}
      >
        <textarea
          className="w-full p-3"
          onChange={(e) => setText(key, { text: e.target.value })}
          placeholder="نوشته"
          value={textObj.text}
        />
      </MultiInput>
    ),
    [setText],
  );

  return (
    <div className="flex w-full max-w-sm flex-col gap-5 text-right sm:max-h-screen sm:overflow-y-scroll">
      <p className="text-xl font-bold">تنظیمات</p>
      <MultiInput
        title="پس زمینه"
        fields={[
          {
            placeholder: 'رنگ',
            value: store.bg,
            onChange: (e) => store.setBg(e.target.value),
            type: 'color',
          },
        ]}
      />
      <MultiInput
        title="بوم"
        fields={[
          {
            placeholder: 'کیفیت',
            value: store.canvasDPI,
            onChange: (e) => setDPI(Number(e.target.value)),
            type: 'number',
          },
        ]}
        selects={[
          {
            options: sizes.map((p, i) => ({ value: i, label: p.n })),
            onChange: (e) => setPaper(Number(e.target.value)),
            value: sizeSelected,
          },
        ]}
      />
      <MultiInput
        title="اندازه تصویر"
        fields={[
          {
            placeholder: 'عرض',
            value: Math.round(store.width),
            onChange: (e) => setSize(e, 'width'),
            type: 'number',
          },
          {
            placeholder: 'طول',
            value: Math.round(store.height),
            onChange: (e) => setSize(e, 'height'),
            type: 'number',
          },
          {
            placeholder: 'گوشه',
            value: store.radius,
            onChange: (e) => store.setRadius(Number(e.target.value)),
            type: 'number',
          },
        ]}
      />
      {renderTextInput(textMain, 'متن دلخواه', 'textMain')}
      {renderTextInput(textCaption, 'متن زیرنویس', 'textCaption')}
      {renderTextInput(textAuthor, 'نام نویسنده', 'textAuthor')}
      <MultiInput
        title="نماد"
        fields={[
          {
            placeholder: 'عرض',
            onChange: (ev) => store.setLogoWidth(Number(ev.target.value)),
            type: 'number',
          },
          {
            placeholder: 'طول',
            onChange: (ev) => store.setLogoHeight(Number(ev.target.value)),
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
            onChange: (e) => store.setLogoPosition(e.target.value as any),
          },
        ]}
      >
        <label
          htmlFor="dropzone-file"
          className="w-full cursor-pointer rounded-lg bg-gray-100 hover:bg-primary hover:text-white"
        >
          <div className="flex flex-col items-center justify-center gap-5 p-3">فایل</div>
          <input id="dropzone-file" type="file" className="hidden" onChange={createLogo} />
        </label>
      </MultiInput>
    </div>
  );
}

export default memo(EditorSidebar);
