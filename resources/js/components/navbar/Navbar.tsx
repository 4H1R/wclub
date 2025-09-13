import { PageProps } from '@/@types';
import config from '@/fixtures/config';
import { useCurrentRoute } from '@/hooks';
import Image from '@/shared/images/Image';
import Search from '@/shared/Search';
import { cn } from '@/utils';
import { Link, usePage } from '@inertiajs/react';
import { motion, useMotionValueEvent, useScroll } from 'framer-motion';
import { useEffect, useRef, useState } from 'react';
import { HiOutlineMagnifyingGlass } from 'react-icons/hi2';
import DesktopLinks from './DesktopLinks';
import MobileDrawerToggle from './MobileDrawerToggle';
import Profile from './Profile';
import TargetGroupSelect from './TargetGroupSelect';

const parentVariants = {
  visible: { opacity: 1, y: 0 },
  hidden: { opacity: 0, y: '-4rem' },
};

export default function Navbar() {
  const [hidden, setHidden] = useState(false);
  const [isScrolled, setIsScrolled] = useState(false);
  const { auth } = usePage<PageProps>().props;
  const { scrollY } = useScroll();
  const lastOpenY = useRef(0);
  const prevScroll = useRef(0);
  const currentRoute = useCurrentRoute();
  const isInSearch = currentRoute.startsWith(route('search', undefined, false));

  useEffect(() => {
    const handleEvent = (e: MouseEvent) => {
      document.querySelectorAll('.desktop-sub-links').forEach((dropdown) => {
        if (!dropdown.contains(e.target as Node)) {
          // eslint-disable-next-line @typescript-eslint/ban-ts-comment
          // @ts-expect-error
          dropdown.open = false;
        }
      });
    };

    window.addEventListener('click', handleEvent);
    return () => {
      window.removeEventListener('click', handleEvent);
    };
  }, []);

  useMotionValueEvent(scrollY, 'change', (latest: number) => {
    if (latest < prevScroll.current) {
      setHidden(false);
    } else if (latest > 200 && latest > lastOpenY.current + 300) {
      setHidden(true);
    }
    setIsScrolled(latest > 50);
    prevScroll.current = latest;
  });

  return (
    <motion.header
      variants={parentVariants}
      animate={hidden ? 'hidden' : 'visible'}
      transition={{
        ease: [0.1, 0.25, 0.3, 1],
        duration: 0.6,
      }}
      className={cn(
        'sticky top-0 z-10 border-b border-base-300 bg-base-100 transition-shadow delay-100',
        { shadow: isScrolled },
      )}
    >
      <div className="container navbar">
        <div
          className={cn('navbar-start grow xl:flex-shrink xl:grow-0', {
            'xl:max-w-fit': !isInSearch,
          })}
        >
          <Link
            href="/"
            className={cn('btn btn-ghost text-lg font-medium hover:bg-transparent md:text-xl', {
              'hidden xl:flex': auth.user,
            })}
          >
            <Image
              src="/images/logo/logo.png"
              width={40}
              height={40}
              alt={`لوگو ${config.websiteTitle}`}
            />
          </Link>
          {auth.user && <Profile className="ml-2 flex xl:hidden" />}
          <TargetGroupSelect />
        </div>
        <DesktopLinks />
        <div className="navbar-end max-w-fit gap-4 xl:flex xl:max-w-none">
          {!isInSearch && (
            <>
              <div className="form-control hidden 2xl:flex">
                <Search url={route('search', undefined, false)} />
              </div>
              <Link
                href={route('search')}
                className="btn btn-circle btn-ghost relative hidden xl:flex 2xl:hidden"
              >
                <HiOutlineMagnifyingGlass className="size-6" />
              </Link>
            </>
          )}
          {auth.user ? (
            <Profile className="dropdown-end hidden xl:flex" />
          ) : (
            <Link className="btn btn-primary hidden xl:flex" href={route('auth')}>
              حساب کاربری
            </Link>
          )}
          <MobileDrawerToggle />
        </div>
      </div>
    </motion.header>
  );
}
