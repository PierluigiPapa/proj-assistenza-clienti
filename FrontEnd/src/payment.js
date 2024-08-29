import dropin from 'braintree-web-drop-in';

export function initializeDropin(containerId, authorization) {
  return new Promise((resolve, reject) => {
    dropin.create({
      authorization: authorization,
      container: containerId,
      locale: 'it_IT',
    }, (err, instance) => {
      if (err) {
        reject(err);
      } else {
        resolve(instance);
      }
    });
  });
}

export function requestPaymentMethod(dropinInstance) {
  return new Promise((resolve, reject) => {
    dropinInstance.requestPaymentMethod((err, payload) => {
      if (err) {
        reject(err);
      } else {
        resolve(payload.nonce);
      }
    });
  });
}
