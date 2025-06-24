import { Head } from '@inertiajs/react';
import React from 'react';

type ContainerProps = {
  children: React.ReactNode;
};

export default function Container({ children }: ContainerProps) {
  return (
    <div className="flex h-max w-full flex-wrap items-center justify-center gap-4 lg:flex-nowrap">
      <Head>
        <link
          href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;500;700;900&family=Lalezar&family=Noto+Nastaliq+Urdu:wght@400&display=swap"
          rel="stylesheet"
        />
      </Head>
      {children}
    </div>
  );
}
