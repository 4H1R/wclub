import { PageProps } from '@/@types';
import { MODAL_ROOT_ID } from '@/shared/modals/BaseModal';
import { THasChildren } from '@/types';
import { cn } from '@/utils';
import { Head, usePage } from '@inertiajs/react';
import parse from 'html-react-parser';
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

type BaseLayoutProps = THasChildren & {
  className?: string;
};

export default function BaseLayout({ children, className }: BaseLayoutProps) {
  const { seo } = usePage<PageProps>().props;
  const theme = 'light';

  return (
    <div data-theme={theme} className={cn('relative flex min-h-screen flex-col', className)}>
      <Head>{parse(seo.head)}</Head>
      <div id={MODAL_ROOT_ID} />
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
