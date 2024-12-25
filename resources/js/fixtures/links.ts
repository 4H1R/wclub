import { TIcon } from '@/types';
import {
  HiEnvelope,
  HiFilm,
  HiHome,
  HiOutlineEnvelope,
  HiOutlineFilm,
  HiOutlineHome,
  HiOutlinePlayCircle,
  HiOutlineQuestionMarkCircle,
  HiOutlineSignal,
  HiOutlineStar,
  HiOutlineTrophy,
  HiPlayCircle,
  HiQuestionMarkCircle,
  HiSignal,
  HiStar,
  HiTrophy,
} from 'react-icons/hi2';

export type TNavbarLink = {
  title: string;
  href: string;
  Icon: TIcon;
  ActiveIcon: TIcon;
  showOn: 'mobile' | 'desktop' | 'all';
  desktopSubLinks?: { title: string; href: string }[];
};

export const navbarLinks: TNavbarLink[] = [
  { title: 'خانه', href: '/', Icon: HiOutlineHome, ActiveIcon: HiHome, showOn: 'mobile' },
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
    title: 'بازی ها',
    href: '/games',
    Icon: HiOutlinePlayCircle,
    ActiveIcon: HiPlayCircle,
    showOn: 'all',
  },
  // {
  //   title: 'باغ های بانوان',
  //   href: '/gardens',
  //   Icon: HiOutlineSparkles,
  //   ActiveIcon: HiSparkles,
  //   showOn: 'all',
  // },
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
    showOn: 'mobile',
  },
  {
    title: 'درباره ما',
    href: '/about-us',
    Icon: HiOutlineQuestionMarkCircle,
    ActiveIcon: HiQuestionMarkCircle,
    showOn: 'mobile',
  },
  {
    title: 'باشگاه بانوان',
    href: '/wclub',
    Icon: HiOutlineFilm,
    ActiveIcon: HiFilm,
    showOn: 'desktop',
    desktopSubLinks: [
      {
        title: 'تماس با ما',
        href: '/contact-us',
      },
      {
        title: 'درباره ما',
        href: '/about-us',
      },
    ],
  },
] as const;

export const footerLinks = [
  {
    title: 'بخش ها',
    links: [
      { title: 'خانه', href: '/' },
      { title: 'بازی ها', href: '/games' },
      { title: 'چالش و مسابقات', href: '/contests' },
      { title: 'دوره های آموزشی', href: '/series' },
      { title: 'چت بات هوشمند', href: '/chatbot' },
    ],
  },
  {
    title: 'خدمات',
    links: [
      // { title: 'باغ های بانوان', href: '/gardens' },
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
