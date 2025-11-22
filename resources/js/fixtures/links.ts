import { PageProps } from '@/@types';
import { TIcon } from '@/types';
import { usePage } from '@inertiajs/react';
import {
  HiChatBubbleLeft,
  HiEnvelope,
  HiFilm,
  HiGift,
  HiHome,
  HiNewspaper,
  HiOutlineChatBubbleLeft,
  HiOutlineEnvelope,
  HiOutlineFilm,
  HiOutlineGift,
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
  desktopSubLinkClassName?: string;
  desktopSubLinks?: { title: string; href: string; children?: { title: string; href: string }[] }[];
};

type TNavbarProps = {
  showOn?: 'mobile' | 'desktop' | 'all';
};

export function useNavbarLinks({ showOn = 'all' }: TNavbarProps): TNavbarLink[] {
  const { props, url } = usePage<PageProps>();
  const { event_program_categories, topics, auth } = props;

  const links: (TNavbarLink | null | false)[] = [
    { title: 'خانه', href: '/', Icon: HiOutlineHome, ActiveIcon: HiHome, showOn: 'mobile' },
    auth.user && {
      title: 'حساب کاربری',
      href: '/dashboard',
      Icon: HiOutlineUser,
      ActiveIcon: HiUser,
      showOn: 'mobile',
    },
    {
      title: 'رویداد ها',
      href: '/event-programs',
      Icon: HiOutlineSignal,
      ActiveIcon: HiSignal,
      showOn: 'mobile',
    },
    event_program_categories.length < 1 && {
      title: 'رویداد ها',
      href: '/event-programs',
      Icon: HiOutlineSignal,
      ActiveIcon: HiSignal,
      showOn: 'desktop',
    },
    event_program_categories.length > 0 && {
      title: 'رویداد ها',
      href: '/event-programs',
      Icon: HiOutlineSignal,
      ActiveIcon: HiSignal,
      desktopSubLinkClassName: 'w-60',
      showOn: 'desktop',
      desktopSubLinks: [
        ...event_program_categories.map((category) => ({
          title: category.title,
          href: `/event-programs?filter[categories_id][0]=${category.id}`,
        })),
        {
          title: 'همه رویداد ها',
          href: '/event-programs',
        },
      ],
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
    {
      title: 'دوره ها',
      href: '/series',
      Icon: HiOutlineFilm,
      ActiveIcon: HiFilm,
      showOn: 'mobile',
    },
    {
      title: 'دوره ها',
      href: '/series',
      Icon: HiOutlineFilm,
      ActiveIcon: HiFilm,
      showOn: 'desktop',
      desktopSubLinks: [
        {
          title: 'حضوری',
          href: '/series?filter[presentation_mode][0]=IN_PERSON',
        },
        {
          title: 'آنلاین',
          href: '/series?filter[presentation_mode][0]=ONLINE',
        },
        {
          title: 'پلتفرم',
          href: '/series?filter[presentation_mode][0]=PLATFORM',
        },
        {
          title: 'همه دوره ها',
          href: '/series',
        },
      ],
      desktopSubLinkClassName: 'w-40',
    },
    {
      title: 'خدمات',
      href: '/services-group',
      Icon: HiOutlineSparkles,
      ActiveIcon: HiSparkles,
      desktopSubLinkClassName: 'w-40',
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
        {
          title: 'چالش و مسابقات',
          href: '/contests',
        },
        {
          title: 'بازی ها',
          href: '/games',
        },
        {
          title: 'هدیه نگار',
          href: '/hn',
        },
      ],
    },
    url.split('?')[0] === '/' && {
      title: 'موضوعات محوری',
      href: '/topics',
      Icon: HiOutlineSparkles,
      ActiveIcon: HiSparkles,
      desktopSubLinkClassName: 'w-60',
      showOn: 'desktop',
      desktopSubLinks: [
        ...topics.map((topic) => ({
          title: topic.title,
          href: `/?topic_id=${topic.id}`,
          children: topic.children.map((child) => ({
            title: child.title,
            href: `/?topic_id=${child.id}`,
          })),
        })),
        {
          title: 'همه موضوعات محوری',
          href: '/',
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
      title: 'هدیه نگار زیست عفیفانه',
      href: '/hn',
      Icon: HiOutlineGift,
      ActiveIcon: HiGift,
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
      title: 'تماس با ما',
      href: '/wclub',
      Icon: HiOutlineFilm,
      ActiveIcon: HiFilm,
      showOn: 'desktop',
      desktopSubLinkClassName: 'w-40',
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
  ];

  const reversedShowOn = showOn === 'mobile' ? 'desktop' : 'mobile';

  return links.filter((link) => {
    if (!link) return false;
    if (showOn === 'all') return true;
    return link.showOn !== reversedShowOn;
  }) as TNavbarLink[];
}

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
      {
        title: 'هدیه نگار زیست عفیفانه',
        href: '/hn',
      },
    ],
  },
] as const;
