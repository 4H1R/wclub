/* eslint-disable @typescript-eslint/no-explicit-any */
import DashboardLayout from '@/layouts/DashboardLayout';
import MainLayout from '@/layouts/MainLayout';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

export async function resolveComponent(name: string) {
  const page: any = await resolvePageComponent(
    `../pages/${name}.tsx`,
    import.meta.glob('../pages/**/*.tsx'),
  );

  page.default.layout =
    page.default.layout ||
    ((page: React.ReactNode) => {
      if (name.includes('dashboard/')) return <DashboardLayout>{page}</DashboardLayout>;
      return <MainLayout>{page}</MainLayout>;
    });

  return page;
}
