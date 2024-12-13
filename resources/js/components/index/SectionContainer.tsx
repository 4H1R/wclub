import { THasChildren } from '@/types';
import { cn } from '@/utils';
import { Link } from '@inertiajs/react';
import { HiOutlineChevronLeft } from 'react-icons/hi2';

type SectionContainerProps = THasChildren & {
  title: string;
  href: string;
  sectionClassName?: string;
};

export default function SectionContainer({
  title,
  href,
  children,
  sectionClassName,
}: SectionContainerProps) {
  return (
    <section className={cn('space-y-4', sectionClassName)}>
      <div className="flex items-center justify-between">
        <h2 className="h1">{title}</h2>
        <Link
          className="btn btn-link text-base-content no-underline transition-transform hover:-translate-x-2 hover:text-primary-solo"
          href={href}
        >
          <span>مشاهده همه</span>
          <HiOutlineChevronLeft className="size-4" />
        </Link>
      </div>
      {children}
    </section>
  );
}
