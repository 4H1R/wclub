import { TNavbarLink } from '@/fixtures/links';
import { cn, isUrlActive } from '@/utils';
import { Link, usePage } from '@inertiajs/react';
import { useCallback, useId, useRef } from 'react';

type DesktopSubLinkProps = {
  link: TNavbarLink;
};

export default function DesktopSubLink({ link }: DesktopSubLinkProps) {
  const url = usePage().url;
  const decodedUrl = decodeURIComponent(url);
  const id = useId();
  const ref = useRef<HTMLDetailsElement>(null);

  const handleClose = useCallback(() => {
    document.getElementById(id)?.removeAttribute('open');
  }, [id]);

  if (!link.desktopSubLinks) return null;

  const renderSubLink = (subLink: {
    title: string;
    href: string;
    children?: { title: string; href: string }[];
  }) => {
    const hasChildren = subLink.children && subLink.children.length > 0;

    if (hasChildren && subLink.children) {
      return (
        <li key={subLink.href}>
          <details>
            <summary className="text-base-content hover:text-primary-solo">{subLink.title}</summary>
            <ul className="menu-dropdown">
              {subLink.children.map((child) => (
                <li key={child.href}>
                  <Link
                    onClick={handleClose}
                    className={cn('text-base-content', {
                      'font-medium text-primary-solo': isUrlActive(decodedUrl, child.href, true),
                    })}
                    href={child.href}
                  >
                    {child.title}
                  </Link>
                </li>
              ))}
            </ul>
          </details>
        </li>
      );
    }

    return (
      <li key={subLink.href}>
        <Link
          onClick={handleClose}
          className={cn('text-base-content', {
            'font-medium text-primary-solo': isUrlActive(decodedUrl, subLink.href, true),
          })}
          href={subLink.href}
        >
          {subLink.title}
        </Link>
      </li>
    );
  };

  return (
    <details className="desktop-sub-links" ref={ref} id={id}>
      <summary>{link.title}</summary>
      <ul
        className={cn(
          'w-32 min-w-fit rounded-t-none bg-base-100 font-normal',
          link.desktopSubLinkClassName,
        )}
      >
        {link.desktopSubLinks.map(renderSubLink)}
      </ul>
    </details>
  );
}
