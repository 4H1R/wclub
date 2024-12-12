import Head from '@/shared/Head';
import Search from '@/shared/Search';
import { usePage } from '@inertiajs/react';
import { useEffect } from 'react';

export default function Index() {
  const url = usePage().url;

  useEffect(() => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }, []);

  return (
    <div className="space-y mt-page container">
      <Head title="جست و جو" description="جست و جو" />
      <div className="flex flex-wrap items-center justify-between gap-4">
        <h1 className="h1 text-base-content">جست و جو</h1>
        <Search key={url} />
      </div>
    </div>
  );
}
