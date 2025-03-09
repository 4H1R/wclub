import config from '@/fixtures/config';
import { THasChildren } from '@/types';
import { cn } from '@/utils';
import { ToastContainer } from 'react-toastify';

type BaseLayoutProps = THasChildren & { className?: string };

export default function BaseLayout({ children, className }: BaseLayoutProps) {
  const theme = 'light';

  return (
    <div
      data-theme={theme}
      className={cn('relative flex min-h-screen flex-col', className, {
        'debug-screens': process.env.NODE_ENV && process.env.NODE_ENV === 'development',
      })}
    >
      <div id={config.modalsId} />
      <ToastContainer
        draggablePercent={50}
        rtl
        limit={5}
        position="top-left"
        toastClassName="!font-fa"
        theme={theme}
      />
      {children}
    </div>
  );
}
