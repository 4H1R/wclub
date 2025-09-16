import config from '@/fixtures/config';
import { footerLinks } from '@/fixtures/links';
import Image from '@/shared/images/Image';
import { Link } from '@inertiajs/react';

export default function Footer() {
  return (
    <section className="relative -space-y-1">
      <svg
        className="absolute -top-5 right-0 fill-current text-primary"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 1440 320"
      >
        <path d="M0,96L80,85.3C160,75,320,53,480,85.3C640,117,800,203,960,224C1120,245,1280,203,1360,181.3L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z" />
      </svg>
      <svg
        className="absolute right-0 top-0 fill-current text-base-200"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 1440 320"
      >
        <path d="M0,96L80,85.3C160,75,320,53,480,85.3C640,117,800,203,960,224C1120,245,1280,203,1360,181.3L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z" />
      </svg>
      <svg
        className="fill-current text-base-200"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 1440 320"
      >
        <path d="M0,96L80,85.3C160,75,320,53,480,85.3C640,117,800,203,960,224C1120,245,1280,203,1360,181.3L1440,160L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z" />
      </svg>
      <footer className="bg-base-200">
        <div className="container footer py-10">
          <aside className="max-w-none space-y-2 md:max-w-[20rem] lg:max-w-sm">
            <Image
              src="/images/logo/logoFull.png"
              width={150}
              height={150}
              alt={`لوگو ${config.websiteTitle}`}
            />
            <p>
              {config.websiteTitle} برای بانوان از کودک تا بزرگسال توسط شهرداری اصفهان تدارک دیده
              شده که بیشترین استفاده را از شهر زیبای اصفهان ببرند.
            </p>
            {/* <Socials /> */}
          </aside>
          {footerLinks.map((link) => (
            <nav key={link.title} className="flex flex-col gap-1">
              <h6 className="footer-title text-lg font-semibold">{link.title}</h6>
              {link.links.map((subLink) => (
                <Link key={subLink.title} href={subLink.href} className="text-md link-hover link">
                  {subLink.title}
                </Link>
              ))}
            </nav>
          ))}
        </div>
      </footer>
    </section>
  );
}
