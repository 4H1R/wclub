import { PageProps } from '@/@types';
import BreadCrumb from '@/shared/BreadCrumb';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import { usePage } from '@inertiajs/react';

type TPage = PageProps<{
  game: App.Data.Game.GameData;
}>;
export default function NardebanShadi() {
  const { game } = usePage<TPage>().props;

  return (
    <div className="mt-page space-y container">
      <Head
        canonicalUrl={route('games.nardeban-shadi')}
        title={game.title}
        description={game.title}
        imageUrl={game.image}
      />
      <BreadCrumb
        links={[
          { title: 'بازی ها', href: route('games.index') },
          { title: game.title, href: '#' },
        ]}
      />
      <div className="side-grid-container">
        <div className="space-y col-span-full lg:col-span-7">
          <div className="space-y-3">
            <h1 className="h1">{game.title}</h1>
            <p className="text-base-content/80">{game.short_description}</p>
            <p>
              نردبان شادی یک بازی جذاب و آموزشی از سری بازی‌های مار و پله است که به‌طور ویژه برای
              کودکان طراحی شده است. این بازی با هدف ایجاد سرگرمی و یادگیری هم‌زمان، تجربه‌ای بی‌نظیر
              برای کودکان و خانواده‌ها فراهم می‌کند. طراحی شاد و رنگارنگ به همراه چندین الگوی متنوع،
              باعث می‌شود این بازی برای تمامی سلیقه‌ها جذاب باشد.
            </p>
            <p>
              نردبان شادی یک بازی جذاب و آموزشی از سری بازی‌های مار و پله است که به‌طور ویژه برای
              کودکان طراحی شده است. این بازی با هدف ایجاد سرگرمی و یادگیری هم‌زمان، تجربه‌ای بی‌نظیر
              برای کودکان و خانواده‌ها فراهم می‌کند. طراحی شاد و رنگارنگ به همراه چندین الگوی متنوع،
              باعث می‌شود این بازی برای تمامی سلیقه‌ها جذاب باشد.
            </p>
            <p>
              یکی از ویژگی‌های متمایز نردبان شادی، امکان انتخاب تم‌ های دخترانه و پسرانه است که باعث
              افزایش جذابیت بازی برای کودکان می‌شود. علاوه بر این، بازیکنان می‌توانند با کسب امتیاز
              در بازی، الگوهای جدید خریداری کنند و تجربه‌ای تازه و متفاوت از بازی به دست آورند. این
              قابلیت، هیجان و انگیزه بیشتری برای ادامه بازی به کودکان می‌دهد.
            </p>
            <p>
              بازی نردبان شادی شامل چندین نوع الگوی خانواده دخترانه و پسرانه است که بازیکنان
              می‌توانند با انتخاب الگوهای مورد علاقه خود، تجربه‌ای شخصی‌تر و جذاب‌تر داشته باشند.
              این ویژگی تنوع بیشتری به بازی می‌بخشد و باعث تقویت حس تعامل کودکان با بازی می‌شود.
            </p>
            <p>
              بازی نردبان شادی به کودکان این امکان را می‌دهد که به‌صورت تک‌نفره یا چند نفره همراه با
              دوستان یا خانواده بازی کنند. این قابلیت، بازی را به گزینه‌ای مناسب برای دورهمی‌های
              خانوادگی و تعامل اجتماعی تبدیل کرده است. لحظات شاد و آموزنده‌ای که در طول این بازی رقم
              می‌خورد، برای تمامی اعضای خانواده خاطره‌انگیز خواهد بود.
            </p>
            <p>
              اگر به دنبال یک بازی متفاوت و آموزشی برای کودکان خود هستید که علاوه بر سرگرمی،
              ارزش‌های اخلاقی را نیز آموزش دهد، نردبان شادی بهترین انتخاب است. همین حالا این بازی را
              دانلود کنید و وارد دنیای ماجراجویی‌های شاد و آموزنده شوید!
            </p>
          </div>
        </div>
        <div className="col-span-full lg:col-span-3">
          <div className="card sticky left-0 top-3 bg-base-200">
            <div className="card-body gap-4">
              <Image
                className="mx-auto w-full rounded-box object-cover md:w-full md:max-w-xs"
                src={game.image}
                alt={game.title}
              />
              <div className="flex items-center justify-between gap-4">
                <h2 className="h3">دانلود بازی</h2>
                <a
                  href="https://nsg.banovan-isfahan.ir/download.apk"
                  target="_blank"
                  rel="noreferrer noopener nofollow"
                  className="btn btn-secondary btn-sm md:btn-md"
                >
                  دانلود
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
