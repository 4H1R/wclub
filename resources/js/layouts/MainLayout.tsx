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
      <div className="drawer relative flex-1">
        <div
          className="absolute size-full bg-contain bg-repeat"
          style={{
            backgroundImage: 'url(/images/bgPattern.webp)',
            filter: 'hue-rotate(0deg) brightness(100%) saturate(200%) opacity(0.01)',
          }}
        />
        <input id={config.mobileDrawerId} type="checkbox" className="drawer-toggle" />
        <div className="drawer-content z-[1] flex flex-col">
          <Navbar />
          <main className="space-y flex flex-1 flex-col pb-8 md:pb-6">{children}</main>
          <Footer />
        </div>
        <div className="drawer-side">
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
