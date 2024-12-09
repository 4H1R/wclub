import { cn } from '@/utils';
import React from 'react';

export interface ButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  isLoading?: boolean;
}

export default function Button({ children, isLoading, className, ...props }: ButtonProps) {
  return (
    <button
      type="button"
      {...props}
      className={cn(className, {
        'cursor-not-allowed': props.disabled && !isLoading,
        'cursor-wait': isLoading,
      })}
    >
      {isLoading ? <span className="loading loading-spinner" /> : children}
    </button>
  );
}
