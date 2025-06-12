// import Upscaler from 'upscaler';
// import * as tf from '@tensorflow/tfjs';
// import * as models from '@upscalerjs/esrgan-slim';

// const upscalers = [
//   { model: models.x2, warmupSizes: 128 },
//   { model: models.x3, warmupSizes: 128 },
//   { model: models.x4, warmupSizes: 128 },
//   { model: models.x8, warmupSizes: 128 },
// ] as const;

// self.onmessage = async (event: MessageEvent) => {
//   try {
//     const [data, shape, model] = event.data;
//     const upscaler = new Upscaler(upscalers[model]);
//     const tensor = tf.tensor<tf.Rank.R3>(data, shape);
//     const old = performance.now();

//     postMessage({ msg: 'شروع به افزایش کیفیت' });

//     const upscaledImg = await upscaler.upscale(tensor, {
//       output: 'tensor',
//       patchSize: 128,
//       padding: 2,
//       progress: (percent: number) => {
//         postMessage({ msg: `درحال افزایش کیفیت {${(percent * 100).toFixed(1)}%}` });
//       },
//     });
//     const upscaledShape = upscaledImg.shape;
//     const upscaledData = await upscaledImg.data();
//     postMessage({ msg: 'done', img: [upscaledData, upscaledShape] });
//     postMessage({ msg: 'درحال پاکسازی' });
//     await upscaler.dispose();
//     const now = performance.now();
//     postMessage({ msg: `شروع فرایند جدید {${(now - old) / 1000}s}` });
//   } catch (error) {
//     postMessage({ msg: 'error' });
//   }
// };

// export {};
