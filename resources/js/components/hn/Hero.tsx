import { Link } from '@inertiajs/react';
import React from 'react';

export default function Hero() {
  return (
    <section className="card !mt-0 bg-gradient-to-b from-primary/40 to-secondary/40">
      <div className="card-body text-center md:text-right">
        <div className="flex flex-col items-center justify-center gap-4">
          <h2 className="text-4xl font-black leading-tight">
            تصاویر خودت رو برای همه جا بساز و استفاده کن
          </h2>
          <p className="text-lg text-base-content/80">
            با هدیه نگار هوشمند زیست عفیفانه تصاویر تبلیغاتی یا حتی هدیه خود را به راحتی بساز و
            خروجی های مختلفی بگیر
          </p>
          <Link href={route('hn.start')} className="btn btn-primary">
            شروع استفاده
          </Link>
        </div>
        <div className="mt-8 grid grid-cols-1 justify-items-center gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
          {Array.from({ length: 4 }).map((_, i) => (
            <img
              key={i}
              className="rounded-box"
              width={250}
              height={250}
              src={`/images/hn/examples/${i + 1}.webp`}
              alt={`خروجی نمونه هدیه نگار زیست عفیفانه ${i + 1}`}
            />
          ))}
        </div>
      </div>
    </section>
  );
}
