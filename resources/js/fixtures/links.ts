import { TIcon } from '@/types';
import {
  HiChatBubbleLeft,
  HiEnvelope,
  HiFilm,
  HiHome,
  HiNewspaper,
  HiOutlineChatBubbleLeft,
  HiOutlineEnvelope,
  HiOutlineFilm,
  HiOutlineHome,
  HiOutlineNewspaper,
  HiOutlinePlayCircle,
  HiOutlineQuestionMarkCircle,
  HiOutlineSignal,
  HiOutlineSparkles,
  HiOutlineStar,
  HiOutlineTrophy,
  HiOutlineUser,
  HiPlayCircle,
  HiQuestionMarkCircle,
  HiSignal,
  HiSparkles,
  HiStar,
  HiTrophy,
  HiUser,
} from 'react-icons/hi2';
import config from './config';

export type TNavbarLink = {
  title: string;
  href: string;
  Icon: TIcon;
  ActiveIcon: TIcon;
  showOn: 'mobile' | 'desktop' | 'all';
  middleware?: 'auth';
  desktopSubLinks?: { title: string; href: string }[];
};

export const navbarLinks: TNavbarLink[] = [
  { title: 'خانه', href: '/', Icon: HiOutlineHome, ActiveIcon: HiHome, showOn: 'mobile' },
  {
    title: 'حساب کاربری',
    href: '/dashboard',
    Icon: HiOutlineUser,
    ActiveIcon: HiUser,
    showOn: 'mobile',
    middleware: 'auth',
  },
  {
    title: 'رویداد ها',
    href: '/event-programs',
    Icon: HiOutlineSignal,
    ActiveIcon: HiSignal,
    showOn: 'all',
  },

  {
    title: 'اخبار',
    href: '/news',
    Icon: HiOutlineNewspaper,
    ActiveIcon: HiNewspaper,
    showOn: 'all',
  },
  {
    title: 'مشاوره',
    href: '/consultations',
    Icon: HiOutlineChatBubbleLeft,
    ActiveIcon: HiChatBubbleLeft,
    showOn: 'mobile',
  },
  {
    title: 'باغ های بانوان',
    href: '/gardens',
    Icon: HiOutlineSparkles,
    ActiveIcon: HiSparkles,
    showOn: 'mobile',
  },
  {
    title: 'خدمات',
    href: '/reward-programs',
    Icon: HiOutlineStar,
    ActiveIcon: HiStar,
    showOn: 'mobile',
  },

  { title: 'دوره ها', href: '/series', Icon: HiOutlineFilm, ActiveIcon: HiFilm, showOn: 'all' },
  {
    title: 'خدمات',
    href: '/services-group',
    Icon: HiOutlineSparkles,
    ActiveIcon: HiSparkles,
    showOn: 'desktop',
    desktopSubLinks: [
      {
        title: 'مشاوره',
        href: '/consultations',
      },
      {
        title: 'خدمات',
        href: '/reward-programs',
      },
      {
        title: 'باغ های بانوان',
        href: '/gardens',
      },
    ],
  },
  {
    title: 'چالش ها و مسابقات',
    href: '/contests',
    Icon: HiOutlineTrophy,
    ActiveIcon: HiTrophy,
    showOn: 'desktop',
    desktopSubLinks: [
      {
        title: 'چالش و مسابقات',
        href: '/contests',
      },
      {
        title: 'بازی ها',
        href: '/games',
      },
    ],
  },
  {
    title: 'چالش و مسابقات',
    href: '/contests',
    Icon: HiOutlineTrophy,
    ActiveIcon: HiTrophy,
    showOn: 'mobile',
  },
  {
    title: 'بازی ها',
    href: '/games',
    Icon: HiOutlinePlayCircle,
    ActiveIcon: HiPlayCircle,
    showOn: 'mobile',
  },
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
    title: config.websiteTitle,
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
      { title: 'اخبار', href: '/news' },
      { title: 'بازی ها', href: '/games' },
      { title: 'چالش و مسابقات', href: '/contests' },
      { title: 'دوره های آموزشی', href: '/series' },
      { title: 'چت بات هوشمند', href: '/chatbot' },
    ],
  },
  {
    title: 'خدمات',
    links: [
      { title: 'مشاوره', href: '/consultations' },
      { title: 'باغ های بانوان', href: '/gardens' },
      { title: 'همه خدمات', href: '/reward-programs' },
    ],
  },
  {
    title: config.websiteTitle,
    links: [
      { title: 'درباره ما', href: '/about-us' },
      { title: 'تماس با ما', href: '/contact-us' },
    ],
  },
] as const;
