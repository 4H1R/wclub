import DrawerContent from '@/components/drawer/DrawerContent';
import Footer from '@/components/footer/Footer';
import Navbar from '@/components/navbar/Navbar';
import config from '@/fixtures/config';
import BaseLayout from '@/layouts/BaseLayout';
import { THasChildren } from '@/types';
import { router } from '@inertiajs/react';
import { useEffect } from 'react';

type MainLayoutProps = THasChildren;

export default function MainLayout({ children }: MainLayoutProps) {
  useEffect(() => {
    router.on('success', () => {
      // close drawer
      const input = document.getElementById(config.mobileDrawerId) as HTMLInputElement | null;
      if (input) input.checked = false;
    });
  }, []);

  return (
    <BaseLayout>
      <div className="drawer">
        <input id={config.mobileDrawerId} type="checkbox" className="drawer-toggle" />
        <div className="drawer-content flex flex-col">
          <Navbar />
          <main className="space-y my-4 flex-1 pb-8 md:pb-0">{children}</main>
          <Footer />
        </div>
        <div className="drawer-side z-20">
          <label
            htmlFor={config.mobileDrawerId}
            aria-label="close sidebar"
            className="drawer-overlay"
          />
          <div className="menu min-h-full w-80 space-y-4 bg-base-200 p-4">
            <DrawerContent />
          </div>
        </div>
      </div>
    </BaseLayout>
  );
}
