import bale from '@/assets/svg/logo/bale.svg';
import eitaa from '@/assets/svg/logo/eitaa.svg';
import rubika from '@/assets/svg/logo/rubika.svg';
import soroush from '@/assets/svg/logo/soroush.svg';
import Image from '@/shared/images/Image';

const socials = [
  { name: 'eitaa', alt: 'لوگو ایتا', src: eitaa, href: '/' },
  { name: 'soroush', alt: 'لوگو سروش پلاس', src: soroush, href: '/' },
  { name: 'bale', alt: 'لوگو بله', src: bale, href: '/' },
  { name: 'rubika', alt: 'لوگو روبیکا', src: rubika, href: '/' },
];

export default function Socials() {
  return (
    <nav className="grid grid-flow-col gap-4">
      {socials.map((social) => (
        <a key={social.name} target="_blank" href={social.href} rel="noopener nofollow noreferrer">
          <Image alt={social.alt} src={social.src} width={24} height={24} />
        </a>
      ))}
    </nav>
  );
}
