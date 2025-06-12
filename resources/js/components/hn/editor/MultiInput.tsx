/* eslint-disable react/no-unknown-property */
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

const MultiInput = ({ fields, selects, title, children }: IProps) => {
  return (
    <div className="flex flex-col justify-start rounded-lg border-2 p-2 sm:bg-gray-50">
      <span className="w-full px-4 py-3 text-center font-black text-gray-800">{title}</span>

      {fields &&
        fields.map(({ value, type, onChange, placeholder }, i) => (
          <input
            key={i}
            value={value}
            type={type || 'text'}
            onChange={onChange}
            placeholder={placeholder}
            className={`block w-full rounded-md bg-transparent text-right outline-none ${type === 'color' ? 'p-0' : 'p-3'}`}
          />
        ))}

      {selects &&
        selects.map(({ options, onChange, value, type }, i) => (
          <select
            key={i}
            value={value}
            onChange={onChange}
            className="rtl block w-full bg-transparent p-3 text-right"
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
};

export default MultiInput;
