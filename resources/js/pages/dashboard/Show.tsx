import Head from '@/shared/Head';
import { usePage } from '@inertiajs/react';

export default function Show() {
  const { auth } = usePage().props;

  return (
    <div className="space-y mt-page container">
      <Head title="داشبورد" description="داشبورد" titleSuffix={null} />
      <h1 className="h1 text-base-content">
        <span className="text-secondary">
          {auth.user?.first_name} {auth.user?.last_name}
        </span>{' '}
        خوش آمدید.
      </h1>
    </div>
  );
}
