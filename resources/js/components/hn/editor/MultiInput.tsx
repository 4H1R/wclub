/* eslint-disable react/no-unknown-property */
import { cn } from '@/utils';
import React, { HTMLInputTypeAttribute, ReactNode } from 'react';

interface Field {
  placeholder: string;
  onChange?: React.ChangeEventHandler<HTMLInputElement>;
  type?: HTMLInputTypeAttribute;
  value?: string | number | readonly string[];
}

interface SelectField {
  options: Array<{ value: string | number; label: string }>;
  onChange: React.ChangeEventHandler<HTMLSelectElement>;
  value?: string | number;
  type?: HTMLInputTypeAttribute;
}

interface IProps {
  fields?: Field[]; // Optional: Input fields
  selects?: SelectField[]; // Optional: Select dropdown fields
  title: string;
  children?: ReactNode;
}

export default function MultiInput({ fields, selects, title, children }: IProps) {
  return (
    <div className="flex flex-col justify-start gap-2 rounded-box border-2 bg-base-100 p-2">
      <span className="w-full px-4 py-3 text-center font-black">{title}</span>
      {fields?.map(({ value, type, onChange, placeholder }, i) => (
        <input
          key={i}
          value={value}
          type={type || 'text'}
          onChange={onChange}
          placeholder={placeholder}
          className={cn('input input-bordered w-full', { 'border-none px-0': type === 'color' })}
        />
      ))}

      {selects?.map(({ options, onChange, value, type }, i) => (
        <select
          key={i}
          value={value}
          onChange={onChange}
          className="select select-bordered w-full"
          typeof={type}
        >
          {options.map(({ value, label }, index) => (
            <option key={index} value={value}>
              {label}
            </option>
          ))}
        </select>
      ))}

      {children}
    </div>
  );
}
