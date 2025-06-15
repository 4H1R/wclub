/* eslint-disable @typescript-eslint/no-unused-vars */
import Editor from '@/components/hn/editor/Editor';
import SelectImages from '@/components/hn/SelectImages';
import Head from '@/shared/Head';
import { cn } from '@/utils';
import React, { useState } from 'react';

type TStep = {
  title: string;
  children: React.ReactNode;
};

export type TData = {
  id: number;
  image: App.Data.Media.ImageData;
};

export default function Start() {
  const [step, setStep] = useState(1);
  const [selectedImage, setSelectedImage] = useState<null | TData>(null);

  const editorRendered = selectedImage && (
    <Editor step={step} setStep={setStep} imgSource={selectedImage?.image.original_url} />
  );

  const steps: Record<number, TStep> = {
    1: {
      title: 'انتخاب تصویر',
      children: (
        <SelectImages
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
