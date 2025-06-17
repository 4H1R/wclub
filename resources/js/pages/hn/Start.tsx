/* eslint-disable @typescript-eslint/no-unused-vars */
import { PageProps } from '@/@types';
import Editor from '@/components/hn/editor/Editor';
import SelectImages from '@/components/hn/SelectImages';
import Head from '@/shared/Head';
import { PaginatedCollection } from '@/types';
import { cn } from '@/utils';
import { usePage } from '@inertiajs/react';
import React, { useState } from 'react';

type TStep = {
  title: string;
  children: React.ReactNode;
};

type TPage = PageProps<{
  data: PaginatedCollection<App.Data.Hn.HnImageData>;
}>;

export default function Start() {
  const [step, setStep] = useState(1);
  const { data } = usePage<TPage>().props;
  const [selectedImage, setSelectedImage] = useState<null | App.Data.Hn.HnImageData>(null);

  const editorRendered = selectedImage && (
    <Editor step={step} setStep={setStep} imgSource={selectedImage?.image!.original_url} />
  );

  const steps: Record<number, TStep> = {
    1: {
      title: 'انتخاب تصویر',
      children: (
        <SelectImages
          data={data}
          onSelect={(image) => {
            setSelectedImage(image);
            setStep(step + 1);
          }}
        />
      ),
    },
    2: {
      title: 'ویرایش عکس',
      children: editorRendered,
    },
    3: {
      title: 'خروجی نهایی',
      children: editorRendered,
    },
  };

  const currentStep = steps[step]!;

  return (
    <div className="space-y mt-page container">
      <Head
        canonicalUrl={route('hn.start')}
        title={currentStep.title}
        description={currentStep.title}
      />
      <ul className="steps steps-vertical w-full lg:steps-horizontal">
        {Object.entries(steps).map(([stepNumber, data]) => (
          <li key={stepNumber} className={cn('step', { 'step-primary': step >= +stepNumber })}>
            {data.title}
          </li>
        ))}
      </ul>
      {currentStep.children}
    </div>
  );
}
