import { PageProps } from '@/@types';
import Image from '@/shared/images/Image';
import { cn } from '@/utils';
import { Link, usePage } from '@inertiajs/react';
import { motion, useMotionValueEvent, useScroll } from 'framer-motion';
import { useRef, useState } from 'react';
import DesktopLinks from './DesktopLinks';
import MobileDrawerToggle from './MobileDrawerToggle';
import Profile from './Profile';

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
        <MobileDrawerToggle />
        <div className="navbar-center lg:navbar-start lg:flex-shrink">
          <Link href="/" className="btn btn-ghost text-xl font-medium">
            <Image
              className="!hidden md:!block"
              src="/images/logo/logo3.webp"
              width={40}
              height={40}
              alt="لوگو بانوان آفتاب"
            />
            <span className="lg:hidden">باشگاه بانوان</span>
          </Link>
        </div>
        <DesktopLinks />
        <div className="navbar-end mr-auto">
          {auth.user ? (
            <Profile />
          ) : (
            <>
              <Link className="btn btn-primary" href={route('register')}>
                حساب کاربری
              </Link>
            </>
          )}
        </div>
      </div>
    </motion.header>
  );
}
