import { cn } from '@/utils';
import React, { useState } from 'react';

export interface ImageProps extends React.ImgHTMLAttributes<HTMLImageElement> {
  hasLoadingBlur?: boolean;
}

export default function Image({ className, hasLoadingBlur = true, ...props }: ImageProps) {
  const [isLoading, setLoading] = useState(false);

  return (
    <img
      loading="lazy"
      {...props}
      className={cn('object-cover duration-75 ease-in-out', className, {
        'blur-lg grayscale': hasLoadingBlur && isLoading,
      })}
      // eslint-disable-next-line react/no-unknown-property
      onLoadStart={() => setLoading(true)}
      onLoad={() => setLoading(false)}
    />
  );
}
