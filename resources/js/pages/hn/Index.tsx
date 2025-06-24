import Hero from '@/components/hn/Hero';
import Head from '@/shared/Head';
import React from 'react';

const title = 'هدیه نگار زیست عفیفانه';

export default function Index() {
  return (
    <div className="space-y mt-page container">
      <Head canonicalUrl={route('hn.index')} title={title} description={title} />
      <h1 className="h1 sr-only text-base-content">{title}</h1>
      <Hero />
    </div>
  );
}
