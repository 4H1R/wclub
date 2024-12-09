import React from 'react';
import { HiMoon } from 'react-icons/hi2';

export type THasChildren = {
  children?: React.ReactNode;
};

export type TIcon = typeof HiMoon;

export type THoneypot = {
  enabled: boolean;
  encryptedValidFrom: string;
  nameFieldName: string;
  unrandomizedNameFieldName: string;
  validFromFieldName: string;
};

export type PaginatedCollection<T extends object> = {
  data: Array<T>;
  links: {
    active: boolean;
    url: string | null;
    label: string;
  }[];
  meta: {
    current_page: number;
    first_page_url: string | null;
    from: number;
    last_page: number;
    last_page_url: string | null;
    next_page_url: string | null;
    path: string;
    per_page: string;
    prev_page_url: string | null;
    to: number;
    total: number;
  };
};
