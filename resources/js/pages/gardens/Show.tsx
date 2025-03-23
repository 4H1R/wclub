import { PageProps } from '@/@types';
import Map from '@/components/gardens/Map';
import BreadCrumb from '@/shared/BreadCrumb';
import GardenCard from '@/shared/cards/GardenCard';
import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import ShareButton from '@/shared/resources/show/ShareButton';
import SwiperContainer from '@/shared/swiper/SwiperContainer';
import SwiperSlide from '@/shared/swiper/SwiperSlide';
import { slugifyId } from '@/utils';
import { usePage } from '@inertiajs/react';
import { addCommas, digitsEnToFa, numberToWords } from '@persian-tools/persian-tools';
import { HiOutlineInformationCircle } from 'react-icons/hi2';
import Markdown from 'react-markdown';

type TPage = PageProps<{
  garden: App.Data.Garden.GardenFullData;
  recommended_gardens: App.Data.Garden.GardenData[];
}>;

const registerId = 'registerId';

export default function Show() {
  const { garden, recommended_gardens } = usePage<TPage>().props;

  const handleScrollToRegister = () => {
    document.getElementById(registerId)?.scrollIntoView({ behavior: 'smooth' });
  };

  return (
    <div className="space-y mt-page container">
      <Head
        canonicalUrl={route('gardens.show', [slugifyId(garden.id, garden.title)])}
        title={`باغ بانوان ${garden.title}`}
        description={garden.address}
        imageUrl={garden.images.at(0)?.original_url}
      />
      <BreadCrumb
        links={[
          { title: 'باغ های بانوان', href: route('gardens.index') },
          { title: garden.title, href: '#' },
        ]}
      />
      <div className="grid grid-cols-10 gap-4">
        <div className="space-y col-span-full lg:col-span-7">
          <SwiperContainer
            id="images"
            className="h-[15rem] w-full rounded-box sm:h-[20rem] md:h-[25rem] lg:h-[30rem]"
            hasPagination={garden.images.length > 1}
          >
            {garden.images.map((image, i) => (
              <SwiperSlide className="relative" key={image.id}>
                <Image
                  src={image.original_url}
                  className="size-full rounded-box object-cover"
                  alt={`عکس ${garden.title} ${numberToWords(i + 1, { ordinal: true })}`}
                />
              </SwiperSlide>
            ))}
          </SwiperContainer>
          <div className="space-y-3">
            <div className="flex flex-wrap items-center justify-between gap-4">
              <h1 className="h1">{garden.title}</h1>
              <ShareButton predefinedStyleFor="desktop" />
            </div>
            <div className="flex flex-wrap items-center justify-between gap-4 rounded-box bg-base-200 text-base-content/80 md:hidden">
              <Button onClick={handleScrollToRegister} className="btn btn-ghost">
                <HiOutlineInformationCircle className="size-5" />
                <span>اطلاعات بیشتر</span>
              </Button>
              <ShareButton predefinedStyleFor="mobile" />
            </div>
          </div>
          <div className="prose max-w-none text-base-content">
            <Markdown>{garden.description}</Markdown>
          </div>
          <Map longitude={garden.longitude} latitude={garden.latitude} />
        </div>
        <div className="col-span-full lg:col-span-3">
          <div id={registerId} className="card sticky left-0 top-3 bg-base-200">
            <div className="card-body">
              <ul className="list-inside list-disc text-base-content/80">
                <li>حداکثر {digitsEnToFa(addCommas(garden.max_participants as number))} فرد</li>
                <li>{garden.address}</li>
              </ul>
              {/* <div className="card-actions mt-4">
                <Button className="btn btn-neutral btn-block">ثبت نام</Button>
              </div> */}
            </div>
          </div>
        </div>
      </div>
      <div className="divider clear-both md:pt-6" />
      <h2 className="h2">باغ بانوان های دیگر</h2>
      <div className="content-grid-container show-content-grid-container">
        {recommended_gardens.map((garden) => (
          <GardenCard key={garden.id} garden={garden} />
        ))}
      </div>
    </div>
  );
}
