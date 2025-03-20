import axios, { AxiosError } from 'axios';
import { ClassValue, clsx } from 'clsx';
import get from 'lodash/get';
import kebabCase from 'lodash/kebabCase';
import { toast } from 'react-toastify';
import { twMerge } from 'tailwind-merge';

const appName = import.meta.env.VITE_APP_NAME;

export function cn(...values: ClassValue[]) {
  return twMerge(clsx(...values));
}

export function createTitle(title: string, parent?: string) {
  return `${title} - ${parent ?? appName}`;
}

export function isSsr() {
  return typeof window === 'undefined';
}

export async function downloadFile(url: string, fileName: string) {
  const { data } = await axios.get(url, { responseType: 'blob' });
  const fileExtension = /(?:\.([^.]+))?$/.exec(url.split('?')[0])?.at(0);

  const link = document.createElement('a');
  link.href = window.URL.createObjectURL(new Blob([data]));
  link.setAttribute('download', `${fileName}${fileExtension}`);

  document.body.appendChild(link);
  link.click();
  link.remove();
}

export const handleServerMessage = (e: unknown, callback?: () => void) => {
  const message = get(e, 'message', '') as string;
  if (message) {
    toast.error(message);
    if (callback) callback();
  }
};

export function convertSecondsToTime(seconds: number, omitHoursIfZero: boolean = false): string {
  const hours = Math.floor(seconds / 3600);
  const minutes = Math.floor((seconds % 3600) / 60);
  const secs = Math.floor(seconds % 60);

  if (omitHoursIfZero && hours === 0) {
    return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
  }

  return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

export function slugifyId(id: number, title: string) {
  return `${kebabCase(title)}-${id}`;
}

export function extractIdFromSlug(slug: string) {
  const matches = slug.match(/\d+$/);
  if (matches) return parseInt(matches[0], 10);
  return null;
}

export function openModal(id: string) {
  (document.getElementById(id) as HTMLDialogElement).showModal();
}

export function closeModal(id: string) {
  (document.getElementById(id) as HTMLDialogElement).close();
}

export function enumTranslationToOptions<T extends object>(options: T) {
  return Object.entries(options).map(([key, value]) => ({ value: key, label: value }));
}

export function convertNullToEmptyString<T extends object>(obj: T): T {
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  const newObject: any = {};

  for (const key in obj) {
    const value = obj[key];
    if (value === null) {
      newObject[key] = '';
    } else {
      newObject[key] = value;
    }
  }

  return newObject;
}

export function isAxiosError<ResponseType>(
  error: unknown,
  statusCode?: number,
): error is AxiosError<ResponseType> {
  return axios.isAxiosError(error) && statusCode ? error.response?.status === statusCode : true;
}

export function isUrlActive(currentUrl: string, targetUrl: string) {
  if (targetUrl === '/') return currentUrl === targetUrl;
  return currentUrl.startsWith(targetUrl);
}
