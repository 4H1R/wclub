import Button from '@/shared/forms/Button';
import { cn } from '@/utils';
import { useState } from 'react';
import { HiOutlinePlusCircle } from 'react-icons/hi2';
import Markdown from 'react-markdown';

type DescriptionProps = { description: string };

export default function Description({ description }: DescriptionProps) {
  const [showAll, setShowAll] = useState(description.length < 480);

  return (
    <div className="flex flex-col gap-4">
      <div className={cn('prose max-w-none', { 'line-clamp-6': !showAll })}>
        <Markdown>{description}</Markdown>
      </div>
      {!showAll && (
        <Button onClick={() => setShowAll(true)} className="btn btn-outline mx-auto max-w-fit">
          <span>مشاهده همه توضیحات</span>
          <HiOutlinePlusCircle className="size-6" />
        </Button>
      )}
    </div>
  );
}
