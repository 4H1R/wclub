import config from '@/fixtures/config';
import { Link } from '@inertiajs/react';

export type TBreadcrumb = {
  title: string;
  href: string;
};

type BreadCrumbProps = {
  links: TBreadcrumb[];
  addBaseToLinks?: boolean;
};

export default function BreadCrumb({ links, addBaseToLinks = true }: BreadCrumbProps) {
  if (addBaseToLinks) {
    links.unshift({ href: '/', title: config.websiteTitle });
  }

  return (
    <div className="breadcrumbs text-base">
      <ul>
        {links.map((link) => (
          <li className="last:text-base-content/80" key={link.title}>
            <Link href={link.href}>{link.title}</Link>
          </li>
        ))}
      </ul>
    </div>
  );
}
