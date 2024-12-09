import Button from '@/shared/forms/Button';
import Search from '@/shared/Search';
import { openModal } from '@/utils';
import { usePage } from '@inertiajs/react';
import { HiFunnel } from 'react-icons/hi2';

export default function Index() {
  const url = usePage().url;

  return (
    <div className="space-y container">
      <div className="flex flex-wrap items-center justify-between gap-4">
        <h1 className="h1 text-base-content">جست و جو</h1>
        <div className="flex items-center gap-4">
          <div className="indicator md:hidden">
            <Button onClick={() => openModal('hi')} className="btn w-[7rem]">
              <HiFunnel className="size-5 text-base-content/90" />
              <span>فیلتر ها</span>
            </Button>
          </div>
          <Search key={url} />
        </div>
      </div>
    </div>
  );
}
