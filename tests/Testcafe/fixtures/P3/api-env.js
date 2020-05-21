import { RequestLogger } from 'testcafe';
import Config from '../../config';
import HomePage from '../../page-models/public/home-page-model';
import GeneralUtils from '../../utils/genericUtils';

const logger = new RequestLogger();
const env = Config.env;
const baseURL = Config.baseUrl[env];
const homePage = new HomePage();
const utils = new GeneralUtils();
const apiURL = Config.apiUrl[Config.apiEnv];
let apiCheck = false;

fixture `===== DRGC P3 Automation Test - Admin: API Environment Test =====`
  .httpAuth({
    username: Config.websiteAuth['username'],
    password: Config.websiteAuth['password'],
  })
  .page(baseURL)
  .requestHooks(logger);

test('Verify API Environment', async t => {
  console.log('Test Case: Verify API Environment');
  console.log('>> Add a product into cart and go to checkout page');
  await t.maximizeWindow();
  await utils.addProductAndProceedToCheckout(homePage.addPhyProduct);

  console.log("API ENVIROMENT SET:" + Config.apiEnv);
  console.log("API ENVIROMENT URL:" + apiURL);

  logger.requests.forEach(function (item, index, array) {
    if (item.request.url.includes(apiURL)) {
      apiCheck = true;
    }
  });

  await t.expect(apiCheck).eql(true);
});
