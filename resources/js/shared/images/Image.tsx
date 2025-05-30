import { cn } from '@/utils';
import React from 'react';

export interface ImageProps extends React.ImgHTMLAttributes<HTMLImageElement> {
  hasLoadingBlur?: boolean;
}

export default function Image({ className, ...props }: ImageProps) {
  return <img loading="lazy" {...props} className={cn('object-cover', className)} />;
}
