import { navbarLinks } from '@/fixtures/links';
import Image from '@/shared/images/Image';
import Search from '@/shared/Search';
import { cn, isUrlActive } from '@/utils';
import { Link, usePage } from '@inertiajs/react';

export default function DrawerContent() {
  const url = usePage().url;

  return (
    <>
      <Image
        className="mx-auto"
        width={150}
        height={150}
        alt="لوگو بانوان آفتاب"
        src="/images/logo/logo3.webp"
      />
      <Search key={url} url={route('search', undefined, false)} />
      <div className="divider" />
      <ul>
        {navbarLinks
          .filter((link) => link.showOn !== 'desktop')
          .map((link) => {
            const isActive = isUrlActive(url, link.href);
            const Icon = isActive ? link.ActiveIcon : link.Icon;

            return (
              <li
                className={cn({
                  'font-medium text-primary-solo': isActive,
                })}
                key={link.title}
              >
                <Link className="flex items-center gap-2" href={link.href}>
                  <Icon className="size-6" />
                  <span className="text-base">{link.title}</span>
                </Link>
              </li>
            );
          })}
      </ul>
    </>
  );
}
