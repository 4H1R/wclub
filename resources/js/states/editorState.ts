import { create } from 'zustand';

export interface IText {
  text: string;
  textSize: number;
  textFont: string;
  textColor: string;
  textAlign: CanvasTextAlign;
  textVAlign: CanvasTextAlign;
}

export type TLogoPosition = '7' | '9' | '1' | '3';

export interface EditorState {
  img?: HTMLImageElement;
  width: number;
  height: number;
  bg: string;
  radius: number;
  canvasWidth: number;
  canvasHeight: number;
  canvasDPI: number;
  logo?: HTMLImageElement;
  logoPosition: TLogoPosition;
  logoWidth: number;
  logoHeight: number;
  textMain: IText;
  textAuthor: IText;
  textCaption: IText;
  sizeSelected: number;
  setInitialState: (img: HTMLImageElement, width: number, height: number) => void;
  setWidth: (width: number) => void;
  setHeight: (height: number) => void;
  setBg: (bg: string) => void;
  setRadius: (radius: number) => void;
  setCanvasWidth: (width: number) => void;
  setCanvasHeight: (height: number) => void;
  setCanvasDPI: (dpi: number) => void;
  setLogo: (logo: HTMLImageElement) => void;
  setLogoPosition: (pos: TLogoPosition) => void;
  setLogoWidth: (width: number) => void;
  setLogoHeight: (height: number) => void;
  setText: (key: 'textMain' | 'textAuthor' | 'textCaption', newText: Partial<IText>) => void;
  setSelectedSize: (sizeSelected: number) => void;
}

const initialTextState: IText = {
  text: '',
  textSize: 24,
  textFont: 'Lalezar',
  textColor: '#da6173',
  textAlign: 'center',
  textVAlign: 'center',
};

export const useEditorStore = create<EditorState>((set) => ({
  img: undefined,
  width: 0,
  height: 0,
  bg: '#ffffff',
  radius: 50,
  canvasWidth: 8.25 * 150,
  canvasHeight: 11.75 * 150,
  canvasDPI: 150,
  logo: undefined,
  logoPosition: '7',
  logoWidth: 50,
  logoHeight: 50,
  textMain: { ...initialTextState },
  textAuthor: { ...initialTextState },
  textCaption: { ...initialTextState },
  sizeSelected: 0,
  setInitialState: (img, width, height) => set({ img, width, height }),
  setWidth: (width) => set({ width }),
  setHeight: (height) => set({ height }),
  setBg: (bg) => set({ bg }),
  setRadius: (radius) => set({ radius }),
  setCanvasWidth: (canvasWidth) => set({ canvasWidth }),
  setCanvasHeight: (canvasHeight) => set({ canvasHeight }),
  setCanvasDPI: (canvasDPI) => set({ canvasDPI }),
  setLogo: (logo) => set({ logo }),
  setLogoPosition: (logoPosition) => set({ logoPosition }),
  setLogoWidth: (logoWidth) => set({ logoWidth }),
  setLogoHeight: (logoHeight) => set({ logoHeight }),
  setText: (key, newText) =>
    set((state) => ({
      [key]: { ...state[key], ...newText },
    })),
  setSelectedSize: (sizeSelected) => set({ sizeSelected }),
}));
