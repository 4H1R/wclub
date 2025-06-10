import BaseCard from '@/shared/cards/BaseCard';
import Head from '@/shared/Head';
import React from 'react';

const options = [
  {
    id: 1,
    href: '/consultations/in-person',
    title: 'مشاوره حضوری',
    short_description:
      'شما میتوانید با یک مشاور حرفه ای در همینجا قرار بگذارید تا با کمک تجربه های مشاور زندگی خود رو بهبود ببخشید. ',
    image: { id: 1, original_url: '/images/consultations/inPerson.webp' },
  },
  {
    id: 2,
    href: '/chatbot',
    title: 'مشاوره هوشمند (هوش مصنوعی)',
    short_description:
      'شما میتوانید با کمک هوش مصنوعی ما صحبتی داشته باشید و از اطلاعات فراوان و بروز هوش مصنوعی کمک بگیرید',
    image: { id: 1, original_url: '/images/consultations/smartAI.webp' },
  },
];

const title = 'مشاوره';

export default function Consultation() {
  return (
    <div className="space-y mt-page container">
      <Head canonicalUrl={route('consultations.index')} title={title} description={title} />
      <h1 className="h1 text-base-content">{title}</h1>
      <div className="content-grid-container">
        {options.map((option) => (
          <BaseCard
            image={{ className: 'object-top' }}
            key={option.id}
            data={option}
            href={option.href}
          />
        ))}
      </div>
    </div>
  );
}
