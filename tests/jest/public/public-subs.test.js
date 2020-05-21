import SubsModule from '../../../assets/js/public/public-subs';

describe('Test createRenewalRequestData', () => {
  test('Create the request data with qty=5', () => {
    const stubRequestData = {
      cart: {
        lineItems: {
          lineItem: [
            {
              quantity: 5,
              product: {
                id: '12345'
              },
              customAttributes: {
                attribute: [
                  {
                    name: 'RenewingSubscriptionID',
                    value: '67890'
                  }
                ]
              }
            }
          ]
        }
      }
    };

    const requestData = SubsModule.createRenewalRequestData('67890', '12345', 5);

    expect(requestData).toEqual(stubRequestData);
  });

  test('Create the request data with qty=10', () => {
    const stubRequestData = {
      cart: {
        lineItems: {
          lineItem: [
            {
              quantity: 10,
              product: {
                id: '12345'
              },
              customAttributes: {
                attribute: [
                  {
                    name: 'RenewingSubscriptionID',
                    value: '67890'
                  }
                ]
              }
            }
          ]
        }
      }
    };

    const requestData = SubsModule.createRenewalRequestData('67890', '12345', 10);

    expect(requestData).toEqual(stubRequestData);
  });
});
