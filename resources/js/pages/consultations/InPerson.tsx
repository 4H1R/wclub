import BreadCrumb from '@/shared/BreadCrumb';
import Head from '@/shared/Head';
import React from 'react';
import { FaExclamation } from 'react-icons/fa6';

const title = 'مشاوره حضوری';

export default function InPerson() {
  return (
    <div className="space-y mt-page container">
      <Head canonicalUrl={route('consultations.in-person')} title={title} description={title} />
      <BreadCrumb
        links={[
          { title: 'مشاوره', href: route('consultations.index') },
          { title: 'حضوری', href: '#' },
        ]}
      />
      <h1 className="h1 text-base-content">{title}</h1>
      <div className="card-bordered col-span-full flex h-44 flex-col items-center justify-center gap-4 rounded-box bg-base-200 shadow-sm">
        <div className="rounded-full bg-base-300 p-4">
          <FaExclamation className="size-6" />
        </div>
        <h3 className="text-xl font-bold">
          ما در حال تکمیل و برنامه ریزی این قابلیت هستیم لطفا چندروز دیگر دوباره این صفحه را چک
          کنید!
        </h3>
      </div>
    </div>
  );
}
