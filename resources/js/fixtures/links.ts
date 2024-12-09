import { TIcon } from '@/types';
import {
  HiEnvelope,
  HiFilm,
  HiHome,
  HiMegaphone,
  HiOutlineEnvelope,
  HiOutlineFilm,
  HiOutlineHome,
  HiOutlineMegaphone,
  HiOutlineSignal,
  HiOutlineSparkles,
  HiOutlineStar,
  HiOutlineTrophy,
  HiSignal,
  HiSparkles,
  HiStar,
  HiTrophy,
} from 'react-icons/hi2';

type TNavbarLink = {
  title: string;
  href: string;
  Icon: TIcon;
  ActiveIcon: TIcon;
  showOn: 'mobile' | 'desktop' | 'all';
};

export const navbarLinks: TNavbarLink[] = [
  { title: 'خانه', href: '/', Icon: HiOutlineHome, ActiveIcon: HiHome, showOn: 'all' },
  {
    title: 'رویداد ها',
    href: '/event-programs',
    Icon: HiOutlineSignal,
    ActiveIcon: HiSignal,
    showOn: 'all',
  },
  {
    title: 'خدمات',
    href: '/reward-programs',
    Icon: HiOutlineStar,
    ActiveIcon: HiStar,
    showOn: 'all',
  },
  {
    title: 'باغ بانوان',
    href: '/educational-stages',
    Icon: HiOutlineSparkles,
    ActiveIcon: HiSparkles,
    showOn: 'all',
  },
  {
    title: 'پویش ها',
    href: '/campaigns',
    Icon: HiOutlineMegaphone,
    ActiveIcon: HiMegaphone,
    showOn: 'all',
  },
  {
    title: 'چالش و مسابقات',
    href: '/contests',
    Icon: HiOutlineTrophy,
    ActiveIcon: HiTrophy,
    showOn: 'all',
  },
  { title: 'دوره ها', href: '/series', Icon: HiOutlineFilm, ActiveIcon: HiFilm, showOn: 'all' },
  {
    title: 'تماس با ما',
    href: '/contact-us',
    Icon: HiOutlineEnvelope,
    ActiveIcon: HiEnvelope,
    showOn: 'all',
  },
] as const;

export const footerLinks = [
  {
    title: 'بخش ها',
    links: [
      { title: 'خانه', href: '/' },
      { title: 'پویش ها', href: '/' },
      { title: 'بازی ها', href: '/' },
      { title: 'چالش و مسابقات', href: '/' },
      { title: 'دوره های آموزشی', href: '/' },
    ],
  },
  {
    title: 'خدمات',
    links: [
      { title: 'باغ بانوان', href: '/' },
      { title: 'همه خدمات', href: '/reward-programs' },
    ],
  },
  {
    title: 'باشگاه بانوان',
    links: [
      { title: 'درباره ما', href: '/about-us' },
      { title: 'تماس با ما', href: '/contact-us' },
    ],
  },
] as const;
