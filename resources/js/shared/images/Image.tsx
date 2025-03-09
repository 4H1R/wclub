import { cn } from '@/utils';
import React, { useState } from 'react';

export interface ImageProps extends React.ImgHTMLAttributes<HTMLImageElement> {
  hasLoadingBlur?: boolean;
}

export default function Image({ className, hasLoadingBlur = true, ...props }: ImageProps) {
  const [isLoading, setLoading] = useState(true);

  return (
    <img
      loading="lazy"
      {...props}
      className={cn('object-cover duration-75 ease-in-out', className, {
        'blur-lg grayscale': hasLoadingBlur && isLoading,
      })}
      onLoad={() => setLoading(false)}
    />
  );
}
