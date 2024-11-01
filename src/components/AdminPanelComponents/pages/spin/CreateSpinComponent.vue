<template>
  <div class="spin-wrap">
    <div class="spin-header">
      <svg
        style="cursor: pointer"
        @click="this.$router.push({ name: 'spin' })"
        data-v-7078eae5=""
        xmlns="http://www.w3.org/2000/svg"
        width="24"
        height="24"
        viewBox="0 0 24 24"
        fill="none"
      >
        <path
          data-v-7078eae5=""
          d="M22.0001 12.0003C22.0001 12.5523 21.5531 13.0003 21.0001 13.0003H5.41413L10.7071 18.2933C11.0981 18.6842 11.0981 19.3163 10.7071 19.7073C10.5121 19.9023 10.2561 20.0003 10.0001 20.0003C9.74407 20.0003 9.48804 19.9023 9.29304 19.7073L2.29401 12.7083C2.20101 12.6153 2.12797 12.5054 2.07697 12.3824C1.97597 12.1384 1.97597 11.8622 2.07697 11.6182C2.12797 11.4952 2.20101 11.3853 2.29401 11.2923L9.29304 4.29325C9.68403 3.90225 10.3161 3.90225 10.7071 4.29325C11.0981 4.68425 11.0981 5.31631 10.7071 5.70731L5.41413 11.0003H21.0001C21.5531 11.0003 22.0001 11.4483 22.0001 12.0003Z"
          fill="#25314C"
        ></path>
      </svg>
      Spin n Win
    </div>
    <div class="spin-quadrants">
      <div class="quadrant-one">
        <div class="quadrant-header">5 Quadrants</div>
        <div class="quadrant-body" @click="toggleQuadrantforFive">
          <div v-if="!isQuadrantSelect" class="tick-sign">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="28"
              height="28"
              viewBox="0 0 28 28"
              fill="none"
            >
              <path
                d="M14.0013 0.666992C6.6413 0.666992 0.667969 6.64033 0.667969 14.0003C0.667969 21.3603 6.6413 27.3337 14.0013 27.3337C21.3613 27.3337 27.3346 21.3603 27.3346 14.0003C27.3346 6.64033 21.3613 0.666992 14.0013 0.666992ZM10.388 19.7203L5.6013 14.9337C5.0813 14.4137 5.0813 13.5737 5.6013 13.0537C6.1213 12.5337 6.9613 12.5337 7.4813 13.0537L11.3346 16.8937L20.508 7.72033C21.028 7.20033 21.868 7.20033 22.388 7.72033C22.908 8.24033 22.908 9.08033 22.388 9.60033L12.268 19.7203C11.7613 20.2403 10.908 20.2403 10.388 19.7203Z"
                fill="#2CC672"
              />
            </svg>
          </div>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="182"
            height="183"
            viewBox="0 0 182 183"
            fill="none"
          >
            <ellipse
              cx="90.4978"
              cy="180.703"
              rx="51.3767"
              ry="1.29522"
              fill="#F5F5F5"
            />
            <path
              d="M91.1406 86.5451C91.1406 86.5451 113.44 56.0132 126.818 37.6934C148.64 53.4657 156.782 80.995 148.871 105.204L91.1406 86.5434V86.5451Z"
              fill="white"
            />
            <path
              d="M91.1438 86.5457C91.1438 86.5457 68.8432 56.0121 55.4648 37.6923C76.1661 22.7257 104.998 21.9216 126.823 37.694C113.443 56.0138 91.1455 86.5457 91.1455 86.5457H91.1438Z"
              fill="#CCCED4"
            />
            <path
              d="M91.1423 146.919V86.5449L148.873 105.205C146.952 111.082 144.098 116.767 140.248 122.037C128.381 138.285 109.895 146.902 91.1406 146.918L91.1423 146.919Z"
              fill="#CCCED4"
            />
            <path
              d="M91.1419 86.5451C91.1419 86.5451 55.0743 98.2028 33.4238 105.202C27.6435 87.4552 30.1699 67.3014 42.0348 51.0534C45.8837 45.784 50.436 41.3255 55.4613 37.6934C68.8396 56.0115 91.1402 86.5468 91.1402 86.5468L91.1419 86.5451Z"
              fill="white"
            />
            <path
              d="M91.14 86.5449V146.919C78.7523 146.929 66.2511 143.195 55.4628 135.397C44.6745 127.599 37.2398 116.925 33.4219 105.202C55.0724 98.2027 91.14 86.5449 91.14 86.5449Z"
              fill="#B4B7C0"
            />
            <path
              d="M74.8365 158.109C75.0112 157.682 75.4271 157.402 75.8889 157.402H105.336C105.798 157.402 106.213 157.682 106.388 158.109L112.276 172.511C112.581 173.259 112.031 174.078 111.223 174.078H70.0015C69.1936 174.078 68.6435 173.259 68.9492 172.511L74.8365 158.109Z"
              fill="#B4B7C0"
            />
            <g filter="url(#filter0_d_504_3390)">
              <path
                d="M53.5352 179.815C53.5352 175.007 57.4531 171.109 62.2862 171.109H118.941C123.774 171.109 127.692 175.007 127.692 179.815C127.692 180.471 127.157 181.002 126.498 181.002H54.7285C54.0694 181.002 53.5352 180.471 53.5352 179.815Z"
                fill="#727889"
              />
            </g>
            <ellipse
              cx="90.7576"
              cy="11.4692"
              rx="11.5272"
              ry="11.4672"
              fill="#8F9BA1"
            />
            <g filter="url(#filter1_d_504_3390)">
              <ellipse
                cx="90.7579"
                cy="11.4685"
                rx="8.52748"
                ry="8.48313"
                fill="#AEB5BE"
              />
            </g>
            <path
              d="M165.851 86.0251C165.851 127.19 132.306 160.561 90.9256 160.561C49.5453 160.561 16 127.19 16 86.0251C16 44.8601 49.5453 11.4893 90.9256 11.4893C132.306 11.4893 165.851 44.8601 165.851 86.0251ZM30.7327 86.0251C30.7327 119.096 57.6819 145.905 90.9256 145.905C124.169 145.905 151.118 119.096 151.118 86.0251C151.118 52.9544 124.169 26.1453 90.9256 26.1453C57.6819 26.1453 30.7327 52.9544 30.7327 86.0251Z"
              fill="#B4B7C0"
            />
            <path
              d="M164.697 86.3127C164.697 126.843 131.604 159.7 90.7822 159.7C49.9601 159.7 16.8672 126.843 16.8672 86.3127C16.8672 45.7822 49.9601 12.9258 90.7822 12.9258C131.604 12.9258 164.697 45.7822 164.697 86.3127ZM29.1151 86.3127C29.1151 120.127 56.7244 147.539 90.7822 147.539C124.84 147.539 152.449 120.127 152.449 86.3127C152.449 52.4982 124.84 25.0862 90.7822 25.0862C56.7244 25.0862 29.1151 52.4982 29.1151 86.3127Z"
              fill="#8F9BA1"
            />
            <path
              d="M75.6528 150.841C75.8947 149.63 77.0894 148.84 78.3134 149.079C79.5375 149.318 80.3364 150.5 80.0945 151.711C79.8526 152.922 78.6653 153.712 77.4339 153.473C76.2025 153.234 75.411 152.059 75.6528 150.841Z"
              fill="#B4B7C0"
            />
            <path
              d="M101.907 151.688C101.665 150.477 102.456 149.295 103.68 149.056C104.905 148.809 106.099 149.6 106.341 150.811C106.59 152.022 105.791 153.204 104.567 153.443C103.351 153.689 102.156 152.899 101.907 151.688Z"
              fill="#B4B7C0"
            />
            <path
              d="M55.3621 29.3948C56.0584 30.4245 55.7799 31.8095 54.7391 32.4984C53.6983 33.1873 52.2984 32.9117 51.6021 31.882C50.9058 30.8523 51.1843 29.4673 52.2251 28.7784C53.2585 28.0968 54.6658 28.3724 55.3621 29.3948Z"
              fill="#B4B7C0"
            />
            <path
              d="M36.1867 47.1677C37.2275 47.8566 37.506 49.2416 36.8171 50.2713C36.1281 51.301 34.7208 51.5765 33.68 50.8949C32.6392 50.206 32.3607 48.821 33.0497 47.7913C33.7387 46.7616 35.1459 46.4861 36.1867 47.1677Z"
              fill="#B4B7C0"
            />
            <path
              d="M25.3483 70.8445C26.5723 71.0838 27.3713 72.2657 27.1294 73.4767C26.8875 74.6877 25.6928 75.4781 24.4688 75.2388C23.2448 74.9995 22.4458 73.8175 22.6877 72.6066C22.9369 71.3956 24.1243 70.6052 25.3483 70.8445Z"
              fill="#B4B7C0"
            />
            <path
              d="M24.493 96.8243C25.717 96.585 26.9117 97.3681 27.1536 98.5791C27.4028 99.7901 26.6039 100.972 25.3799 101.211C24.1558 101.451 22.9611 100.667 22.7193 99.4565C22.4774 98.2455 23.269 97.0636 24.493 96.8243Z"
              fill="#B4B7C0"
            />
            <path
              d="M33.7524 121.155C34.7859 120.466 36.1931 120.741 36.8895 121.771C37.5858 122.801 37.3072 124.186 36.2664 124.875C35.2257 125.563 33.8257 125.288 33.1294 124.258C32.4331 123.229 32.7116 121.843 33.7524 121.155Z"
              fill="#B4B7C0"
            />
            <path
              d="M51.7137 140.123C52.4027 139.094 53.81 138.818 54.8508 139.5C55.8916 140.181 56.1701 141.574 55.4811 142.603C54.7848 143.633 53.3849 143.909 52.3441 143.227C51.3033 142.538 51.0248 141.146 51.7137 140.123Z"
              fill="#B4B7C0"
            />
            <path
              d="M126.497 142.531C125.8 141.501 126.079 140.116 127.12 139.427C128.16 138.738 129.56 139.014 130.257 140.043C130.953 141.073 130.674 142.458 129.634 143.147C128.6 143.836 127.193 143.56 126.497 142.531Z"
              fill="#B4B7C0"
            />
            <path
              d="M145.668 124.757C144.628 124.068 144.349 122.683 145.038 121.654C145.734 120.624 147.134 120.348 148.175 121.03C149.216 121.719 149.494 123.104 148.805 124.134C148.116 125.163 146.709 125.446 145.668 124.757Z"
              fill="#B4B7C0"
            />
            <path
              d="M156.508 101.082C155.284 100.842 154.485 99.6603 154.727 98.4493C154.969 97.2384 156.156 96.448 157.387 96.6872C158.611 96.9265 159.41 98.1085 159.168 99.3195C158.919 100.53 157.732 101.321 156.508 101.082Z"
              fill="#B4B7C0"
            />
            <path
              d="M157.359 75.1011C156.134 75.3404 154.94 74.5572 154.698 73.3462C154.449 72.1353 155.248 70.9533 156.472 70.714C157.696 70.4675 158.89 71.2579 159.132 72.4688C159.381 73.6798 158.59 74.8618 157.359 75.1011Z"
              fill="#B4B7C0"
            />
            <path
              d="M148.102 50.7779C147.062 51.4668 145.654 51.1912 144.965 50.1615C144.269 49.1318 144.548 47.7468 145.588 47.0579C146.629 46.3691 148.029 46.6446 148.725 47.6743C149.422 48.6967 149.143 50.089 148.102 50.7779Z"
              fill="#B4B7C0"
            />
            <path
              d="M130.145 31.8094C129.449 32.8391 128.049 33.1146 127.008 32.433C125.967 31.7441 125.689 30.3591 126.378 29.3294C127.074 28.2997 128.474 28.0242 129.515 28.7058C130.556 29.3874 130.834 30.7797 130.145 31.8094Z"
              fill="#B4B7C0"
            />
            <path
              d="M106.211 21.0851C105.97 22.2961 104.775 23.0865 103.551 22.8472C102.327 22.6079 101.528 21.4259 101.77 20.2149C102.012 19.004 103.199 18.2136 104.43 18.4529C105.654 18.6922 106.453 19.8741 106.211 21.0851Z"
              fill="#B4B7C0"
            />
            <path
              d="M79.9526 20.2373C80.1944 21.4483 79.4028 22.6302 78.1788 22.8695C76.9548 23.1161 75.7601 22.3257 75.5182 21.1147C75.269 19.9037 76.0679 18.7218 77.2919 18.4825C78.5086 18.2432 79.7033 19.0263 79.9526 20.2373Z"
              fill="#B4B7C0"
            />
            <path
              d="M90.7936 90.4574C93.193 90.4574 95.138 88.5331 95.138 86.1594C95.138 83.7856 93.193 81.8613 90.7936 81.8613C88.3943 81.8613 86.4492 83.7856 86.4492 86.1594C86.4492 88.5331 88.3943 90.4574 90.7936 90.4574Z"
              fill="white"
            />
            <path
              d="M94.2662 86.1595C94.2662 88.0563 92.7105 89.5954 90.7932 89.5954C88.876 89.5954 87.3203 88.0563 87.3203 86.1595C87.3203 84.2628 88.876 82.7236 90.7932 82.7236C92.7105 82.7236 94.2662 84.2628 94.2662 86.1595Z"
              fill="#8F9BA1"
            />
            <g filter="url(#filter2_d_504_3390)">
              <path
                d="M98.5184 13.1797C98.5184 17.4454 95.1057 30.7322 90.8959 30.7322C86.6861 30.7322 83.2734 17.4454 83.2734 13.1797C83.2734 8.91406 86.6861 5.45605 90.8959 5.45605C95.1057 5.45605 98.5184 8.91406 98.5184 13.1797Z"
                fill="url(#paint0_radial_504_3390)"
              />
            </g>
            <ellipse
              cx="90.8963"
              cy="13.1804"
              rx="4.91588"
              ry="4.98114"
              fill="#8F9BA1"
            />
            <ellipse
              cx="90.8955"
              cy="13.1799"
              rx="3.25875"
              ry="3.30201"
              fill="#F3F0FF"
            />
            <defs>
              <filter
                id="filter0_d_504_3390"
                x="50.4087"
                y="166.846"
                width="80.4092"
                height="16.1455"
                filterUnits="userSpaceOnUse"
                color-interpolation-filters="sRGB"
              >
                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                <feColorMatrix
                  in="SourceAlpha"
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                  result="hardAlpha"
                />
                <feOffset dy="-1.1369" />
                <feGaussianBlur stdDeviation="1.56324" />
                <feComposite in2="hardAlpha" operator="out" />
                <feColorMatrix
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                />
                <feBlend
                  mode="normal"
                  in2="BackgroundImageFix"
                  result="effect1_dropShadow_504_3390"
                />
                <feBlend
                  mode="normal"
                  in="SourceGraphic"
                  in2="effect1_dropShadow_504_3390"
                  result="shape"
                />
              </filter>
              <filter
                id="filter1_d_504_3390"
                x="81.0936"
                y="2.98535"
                width="19.3285"
                height="19.2396"
                filterUnits="userSpaceOnUse"
                color-interpolation-filters="sRGB"
              >
                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                <feColorMatrix
                  in="SourceAlpha"
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                  result="hardAlpha"
                />
                <feOffset dy="1.1369" />
                <feGaussianBlur stdDeviation="0.56845" />
                <feComposite in2="hardAlpha" operator="out" />
                <feColorMatrix
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                />
                <feBlend
                  mode="normal"
                  in2="BackgroundImageFix"
                  result="effect1_dropShadow_504_3390"
                />
                <feBlend
                  mode="normal"
                  in="SourceGraphic"
                  in2="effect1_dropShadow_504_3390"
                  result="shape"
                />
              </filter>
              <filter
                id="filter2_d_504_3390"
                x="80.9733"
                y="5.45605"
                width="19.8463"
                height="29.8766"
                filterUnits="userSpaceOnUse"
                color-interpolation-filters="sRGB"
              >
                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                <feColorMatrix
                  in="SourceAlpha"
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                  result="hardAlpha"
                />
                <feOffset dy="2.30012" />
                <feGaussianBlur stdDeviation="1.15006" />
                <feComposite in2="hardAlpha" operator="out" />
                <feColorMatrix
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0"
                />
                <feBlend
                  mode="normal"
                  in2="BackgroundImageFix"
                  result="effect1_dropShadow_504_3390"
                />
                <feBlend
                  mode="normal"
                  in="SourceGraphic"
                  in2="effect1_dropShadow_504_3390"
                  result="shape"
                />
              </filter>
              <radialGradient
                id="paint0_radial_504_3390"
                cx="0"
                cy="0"
                r="1"
                gradientUnits="userSpaceOnUse"
                gradientTransform="translate(90.896 18.0937) scale(9.0489 15.0031)"
              >
                <stop stop-color="#EBEBEB" />
                <stop offset="1" stop-color="#FDFDFD" />
              </radialGradient>
            </defs>
          </svg>
        </div>
      </div>
      <div class="quadrant-two">
        <div class="quadrant-header">7 Quadrants</div>
        <div class="quadrant-body" @click="toggleQuadrantforSeven">
          <div class="tick-sign">
            <svg
              height="28"
              viewBox="0 0 28 28"
              width="28"
              xmlns="http://www.w3.org/2000/svg"
            >
              <g id="Layer_2" data-name="Layer 2">
                <path
                  d="m18.5 20.5h-13a1 1 0 0 1 0-2h13a1 1 0 0 1 0 2z"
                  fill="#9c34c2"
                />
                <path
                  d="m21.13 6.25a2 2 0 0 0 -2.24-.08l-2.42 1.4-2.76-4.15a2.06 2.06 0 0 0 -3.42 0l-2.83 4.16-2.36-1.41a2 2 0 0 0 -3.1 2.16l1.47 7.32a2 2 0 0 0 2 1.65h13a2 2 0 0 0 2-1.65l1.53-7.32a2 2 0 0 0 -.87-2.08z"
                  fill="#ffce29"
                />
                <circle cx="12" cy="12.5" fill="#ffa500" r="2" />
              </g>
            </svg>
          </div>
          <svg
            width="182"
            height="184"
            viewBox="0 0 182 184"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M74.8925 158.268C75.0682 157.838 75.4862 157.558 75.9504 157.558H105.42C105.884 157.558 106.302 157.838 106.478 158.268L112.367 172.675C112.675 173.427 112.122 174.25 111.309 174.25H70.0612C69.249 174.25 68.696 173.427 69.0033 172.675L74.8925 158.268Z"
              fill="#B4B7C0"
            />
            <g filter="url(#filter0_d_504_3487)">
              <path
                d="M53.5703 179.994C53.5703 175.181 57.4922 171.279 62.3301 171.279H119.041C123.879 171.279 127.8 175.181 127.8 179.994C127.8 180.65 127.266 181.182 126.606 181.182H54.7648C54.1051 181.182 53.5703 180.65 53.5703 179.994Z"
                fill="#727889"
              />
            </g>
            <ellipse
              cx="90.8316"
              cy="11.4787"
              rx="11.5386"
              ry="11.4787"
              fill="#8F9BA1"
            />
            <g filter="url(#filter1_d_504_3487)">
              <ellipse
                cx="90.8328"
                cy="11.478"
                rx="8.53596"
                ry="8.49162"
                fill="#AEB5BE"
              />
            </g>
            <path
              d="M166 86.1115C166 127.318 132.421 160.722 91 160.722C49.5786 160.722 16 127.318 16 86.1115C16 44.9052 49.5786 11.501 91 11.501C132.421 11.501 166 44.9052 166 86.1115ZM30.7473 86.1115C30.7473 119.215 57.7234 146.051 91 146.051C124.277 146.051 151.253 119.215 151.253 86.1115C151.253 53.0076 124.277 26.1717 91 26.1717C57.7234 26.1717 30.7473 53.0076 30.7473 86.1115Z"
              fill="#B4B7C0"
            />
            <path
              d="M164.844 86.3989C164.844 126.97 131.718 159.859 90.8556 159.859C49.9929 159.859 16.8672 126.97 16.8672 86.3989C16.8672 45.8278 49.9929 12.9385 90.8556 12.9385C131.718 12.9385 164.844 45.8278 164.844 86.3989ZM29.1273 86.3989C29.1273 120.247 56.764 147.687 90.8556 147.687C124.947 147.687 152.584 120.247 152.584 86.3989C152.584 52.5506 124.947 25.1111 90.8556 25.1111C56.764 25.1111 29.1273 52.5506 29.1273 86.3989Z"
              fill="#8F9BA1"
            />
            <path
              d="M75.7076 150.99C75.9497 149.778 77.1456 148.987 78.3708 149.226C79.5961 149.466 80.3958 150.649 80.1537 151.861C79.9115 153.073 78.723 153.865 77.4904 153.625C76.2578 153.386 75.4655 152.21 75.7076 150.99Z"
              fill="#B4B7C0"
            />
            <path
              d="M101.989 151.838C101.747 150.626 102.539 149.443 103.764 149.203C104.99 148.957 106.185 149.748 106.428 150.96C106.677 152.172 105.877 153.355 104.652 153.595C103.434 153.842 102.238 153.05 101.989 151.838Z"
              fill="#B4B7C0"
            />
            <path
              d="M55.3975 29.4231C56.0945 30.4539 55.8157 31.8403 54.7738 32.5298C53.732 33.2194 52.3307 32.9436 51.6337 31.9128C50.9367 30.8821 51.2155 29.4957 52.2573 28.8062C53.2918 28.1239 54.7005 28.3997 55.3975 29.4231Z"
              fill="#B4B7C0"
            />
            <path
              d="M36.2058 47.213C37.2477 47.9026 37.5265 49.289 36.8368 50.3197C36.1471 51.3504 34.7385 51.6263 33.6966 50.9439C32.6548 50.2544 32.376 48.868 33.0657 47.8373C33.7553 46.8065 35.164 46.5307 36.2058 47.213Z"
              fill="#B4B7C0"
            />
            <path
              d="M25.3549 70.9148C26.5802 71.1544 27.3799 72.3375 27.1378 73.5497C26.8956 74.7619 25.6997 75.5531 24.4745 75.3135C23.2493 75.074 22.4495 73.8909 22.6917 72.6787C22.9411 71.4665 24.1297 70.6753 25.3549 70.9148Z"
              fill="#B4B7C0"
            />
            <path
              d="M24.4987 96.922C25.724 96.6824 26.9198 97.4664 27.162 98.6785C27.4114 99.8907 26.6117 101.074 25.3865 101.313C24.1612 101.553 22.9653 100.769 22.7232 99.5568C22.4811 98.3446 23.2735 97.1615 24.4987 96.922Z"
              fill="#B4B7C0"
            />
            <path
              d="M33.769 121.273C34.8035 120.584 36.2122 120.859 36.9092 121.89C37.6062 122.921 37.3274 124.307 36.2856 124.997C35.2437 125.686 33.8424 125.411 33.1454 124.38C32.4484 123.349 32.7272 121.963 33.769 121.273Z"
              fill="#B4B7C0"
            />
            <path
              d="M51.7454 140.263C52.435 139.232 53.8437 138.956 54.8855 139.639C55.9273 140.321 56.2061 141.715 55.5165 142.745C54.8195 143.776 53.4182 144.052 52.3763 143.37C51.3345 142.68 51.0557 141.287 51.7454 140.263Z"
              fill="#B4B7C0"
            />
            <path
              d="M126.602 142.671C125.905 141.64 126.184 140.254 127.226 139.564C128.268 138.875 129.669 139.15 130.366 140.181C131.063 141.212 130.784 142.598 129.743 143.288C128.708 143.977 127.299 143.702 126.602 142.671Z"
              fill="#B4B7C0"
            />
            <path
              d="M145.798 124.88C144.756 124.191 144.478 122.805 145.167 121.774C145.864 120.743 147.266 120.467 148.307 121.15C149.349 121.839 149.628 123.226 148.938 124.256C148.249 125.287 146.84 125.57 145.798 124.88Z"
              fill="#B4B7C0"
            />
            <path
              d="M156.646 101.182C155.421 100.942 154.621 99.759 154.864 98.5468C155.106 97.3346 156.294 96.5435 157.527 96.783C158.752 97.0225 159.552 98.2057 159.31 99.4179C159.06 100.63 157.872 101.421 156.646 101.182Z"
              fill="#B4B7C0"
            />
            <path
              d="M157.498 75.1739C156.273 75.4134 155.077 74.6295 154.835 73.4173C154.585 72.2051 155.385 71.0219 156.61 70.7824C157.835 70.5356 159.031 71.3268 159.273 72.539C159.523 73.7512 158.73 74.9343 157.498 75.1739Z"
              fill="#B4B7C0"
            />
            <path
              d="M148.231 50.8279C147.189 51.5175 145.78 51.2416 145.091 50.2109C144.394 49.1802 144.673 47.7938 145.714 47.1042C146.756 46.4147 148.158 46.6905 148.855 47.7212C149.552 48.7447 149.273 50.1383 148.231 50.8279Z"
              fill="#B4B7C0"
            />
            <path
              d="M130.259 31.8402C129.562 32.8709 128.16 33.1468 127.119 32.4645C126.077 31.7749 125.798 30.3885 126.488 29.3578C127.185 28.327 128.586 28.0512 129.628 28.7335C130.67 29.4158 130.948 30.8095 130.259 31.8402Z"
              fill="#B4B7C0"
            />
            <path
              d="M106.294 21.1044C106.052 22.3166 104.856 23.1078 103.631 22.8682C102.406 22.6287 101.606 21.4455 101.848 20.2334C102.09 19.0212 103.279 18.23 104.511 18.4695C105.736 18.7091 106.536 19.8922 106.294 21.1044Z"
              fill="#B4B7C0"
            />
            <path
              d="M80.0117 20.2557C80.2538 21.4679 79.4614 22.651 78.2362 22.8906C77.0109 23.1374 75.815 22.3462 75.5729 21.134C75.3235 19.9218 76.1232 18.7386 77.3484 18.4991C78.5663 18.2596 79.7622 19.0435 80.0117 20.2557Z"
              fill="#B4B7C0"
            />
            <path
              d="M90.8721 90.5481C93.2739 90.5481 95.2209 88.6219 95.2209 86.2457C95.2209 83.8696 93.2739 81.9434 90.8721 81.9434C88.4704 81.9434 86.5234 83.8696 86.5234 86.2457C86.5234 88.6219 88.4704 90.5481 90.8721 90.5481Z"
              fill="white"
            />
            <path
              d="M94.3473 86.245C94.3473 88.1437 92.79 89.6843 90.8709 89.6843C88.9518 89.6843 87.3945 88.1437 87.3945 86.245C87.3945 84.3463 88.9518 82.8057 90.8709 82.8057C92.79 82.8057 94.3473 84.3463 94.3473 86.245Z"
              fill="#8F9BA1"
            />
            <g filter="url(#filter2_d_504_3487)">
              <path
                d="M98.6 13.1943C98.6 17.4642 95.1839 30.7643 90.9699 30.7643C86.7559 30.7643 83.3398 17.4642 83.3398 13.1943C83.3398 8.92436 86.7559 5.46289 90.9699 5.46289C95.1839 5.46289 98.6 8.92436 98.6 13.1943Z"
                fill="url(#paint0_radial_504_3487)"
              />
            </g>
            <ellipse
              cx="90.9715"
              cy="13.1941"
              rx="4.92076"
              ry="4.98613"
              fill="#8F9BA1"
            />
            <ellipse
              cx="90.969"
              cy="13.194"
              rx="3.26199"
              ry="3.30532"
              fill="#F3F0FF"
            />
            <ellipse
              cx="91.0017"
              cy="182.477"
              rx="51.3767"
              ry="1.29523"
              fill="#F5F5F5"
            />
            <path
              d="M90.8571 85.9522C90.8571 85.9522 61.3409 109.358 43.6254 123.404C40.8665 119.955 38.4362 116.163 36.4338 112.024C30.2536 99.258 29.0299 85.3972 31.9805 72.5801C54.0689 77.5976 90.8571 85.9539 90.8571 85.9539V85.9522Z"
              fill="#CBCBCB"
            />
            <path
              d="M90.8571 85.9532C90.8571 85.9532 54.0688 77.5969 31.9805 72.581C35.9391 55.3815 47.4249 40.0633 64.6475 31.8125C74.4765 52.1159 90.8571 85.9532 90.8571 85.9532Z"
              fill="white"
            />
            <path
              d="M90.8541 85.9536C90.8541 85.9536 74.4736 52.1163 64.6445 31.8129C81.874 23.5588 101.084 24.1802 117.072 31.8333L90.8524 85.9536H90.8541Z"
              fill="#CCCED4"
            />
            <path
              d="M90.8555 85.9542L117.075 31.834C128.979 37.5326 139.102 47.1215 145.279 59.8825C147.286 64.0283 148.753 68.2899 149.744 72.594L90.8572 85.9559L90.8555 85.9542Z"
              fill="#B4B7C0"
            />
            <path
              d="M138.092 123.43L90.8555 85.9557L149.742 72.5938C153.884 90.5901 149.385 109.322 138.092 123.43Z"
              fill="white"
            />
            <path
              d="M90.8599 85.9531L138.097 123.427C132.613 130.278 125.531 136.038 117.068 140.094C108.598 144.151 99.6466 146.066 90.8359 146.058C90.8445 123.528 90.8582 85.9548 90.8582 85.9548L90.8599 85.9531Z"
              fill="#CCCED4"
            />
            <path
              d="M90.855 85.9531C90.855 85.9531 90.8413 123.528 90.8327 146.056C72.7047 146.036 55.1792 137.852 43.625 123.405C61.3388 109.359 90.8567 85.9531 90.8567 85.9531H90.855Z"
              fill="#B4B7C0"
            />
            <defs>
              <filter
                id="filter0_d_504_3487"
                x="50.4275"
                y="166.994"
                width="80.5161"
                height="16.188"
                filterUnits="userSpaceOnUse"
                color-interpolation-filters="sRGB"
              >
                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                <feColorMatrix
                  in="SourceAlpha"
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                  result="hardAlpha"
                />
                <feOffset dy="-1.14284" />
                <feGaussianBlur stdDeviation="1.57141" />
                <feComposite in2="hardAlpha" operator="out" />
                <feColorMatrix
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                />
                <feBlend
                  mode="normal"
                  in2="BackgroundImageFix"
                  result="effect1_dropShadow_504_3487"
                />
                <feBlend
                  mode="normal"
                  in="SourceGraphic"
                  in2="effect1_dropShadow_504_3487"
                  result="shape"
                />
              </filter>
              <filter
                id="filter1_d_504_3487"
                x="81.154"
                y="2.98633"
                width="19.356"
                height="19.2691"
                filterUnits="userSpaceOnUse"
                color-interpolation-filters="sRGB"
              >
                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                <feColorMatrix
                  in="SourceAlpha"
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                  result="hardAlpha"
                />
                <feOffset dy="1.14284" />
                <feGaussianBlur stdDeviation="0.571421" />
                <feComposite in2="hardAlpha" operator="out" />
                <feColorMatrix
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"
                />
                <feBlend
                  mode="normal"
                  in2="BackgroundImageFix"
                  result="effect1_dropShadow_504_3487"
                />
                <feBlend
                  mode="normal"
                  in="SourceGraphic"
                  in2="effect1_dropShadow_504_3487"
                  result="shape"
                />
              </filter>
              <filter
                id="filter2_d_504_3487"
                x="81.0277"
                y="5.46289"
                width="19.886"
                height="29.926"
                filterUnits="userSpaceOnUse"
                color-interpolation-filters="sRGB"
              >
                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                <feColorMatrix
                  in="SourceAlpha"
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"
                  result="hardAlpha"
                />
                <feOffset dy="2.31214" />
                <feGaussianBlur stdDeviation="1.15607" />
                <feComposite in2="hardAlpha" operator="out" />
                <feColorMatrix
                  type="matrix"
                  values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0"
                />
                <feBlend
                  mode="normal"
                  in2="BackgroundImageFix"
                  result="effect1_dropShadow_504_3487"
                />
                <feBlend
                  mode="normal"
                  in="SourceGraphic"
                  in2="effect1_dropShadow_504_3487"
                  result="shape"
                />
              </filter>
              <radialGradient
                id="paint0_radial_504_3487"
                cx="0"
                cy="0"
                r="1"
                gradientUnits="userSpaceOnUse"
                gradientTransform="translate(90.9699 18.1132) scale(9.05789 15.0181)"
              >
                <stop stop-color="#EBEBEB" />
                <stop offset="1" stop-color="#FDFDFD" />
              </radialGradient>
            </defs>
          </svg>
        </div>
      </div>
    </div>

    <div class="form-in-line">
      <div class="form-group custom-group">
        <div class="reward-header">Title</div>
        <input
          type="text"
          class="title-input"
          placeholder="Enter Title"
          v-model="title"
        />
      </div>
      <div class="form-group custom-group">
        <div class="reward-header">Campaign Time</div>
        <select v-model="campaign_time">
          <option disabled>Select Campaign Time</option>
          <option value="3 Days">3 Days</option>
          <option value="" disabled style="color: #ffce29">
            ─────────────────────────────────────────────
          </option>
          <option value="6 Hours" disabled>6 Hours</option>
          <option value="12 Hours" disabled>12 Hours</option>
          <option value="24 Hours" disabled>24 Hours</option>
          <option value="7 Days" disabled>7 Days</option>
          <option value="30 Days" disabled>30 Days</option>
        </select>
      </div>
    </div>

    <div class="form-in-line">
      <div class="form-group custom-group">
        <div class="reward-header">"Shop Now" Link</div>
        <input
          type="text"
          class="title-input"
          placeholder="https://trivialy.co"
          v-model="link"
        />
      </div>
      <div class="form-group custom-group">
        <div class="reward-header">Popup Timing</div>
        <select v-model="popup_time">
          <option disabled>Select Popup Timing</option>
          <option value="30 seconds">30 seconds</option>
          <option value="" disabled style="color: #ffce29">
            ─────────────────────────────────────────────
          </option>
          <option value="15 seconds" disabled>15 seconds</option>
          <option value="1 Minutes" disabled>1 Minutes</option>
          <option value="5 Minutes" disabled>5 Minutes</option>
          <option value="30 Minutes" disabled>30 Minutes</option>
          <option value="1 Hour" disabled>1 Hour</option>
        </select>
      </div>
    </div>

    <div class="reward-header">Rewards</div>
    <div class="reward-input-section-body">
      <div class="reward-input-section">
        <div class="input-group">
          <div class="quadrant-no">1</div>
          <input
            type="text"
            placeholder="Reward Title (Max 2 Words)"
            v-model="reward.reward_one"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="coupon.coupon_one"
          />
        </div>
        <div class="input-group">
          <div class="quadrant-no">2</div>
          <input
            type="text"
            placeholder="Reward Title (Max 2 Words)"
            v-model="reward.reward_two"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="coupon.coupon_two"
          />
        </div>
      </div>
      <div class="reward-input-section">
        <div class="input-group">
          <div class="quadrant-no">3</div>
          <input
            type="text"
            placeholder="Reward Title (Max 2 Words)"
            v-model="reward.reward_three"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="coupon.coupon_three"
          />
        </div>
        <div class="input-group">
          <div class="quadrant-no">4</div>
          <input
            type="text"
            placeholder="Reward Title (Max 2 Words)"
            v-model="reward.reward_four"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="coupon.coupon_four"
          />
        </div>
      </div>
      <div class="reward-input-section">
        <div class="input-group" :class="isQuadrantSelect ? '' : 'odd-section'">
          <div class="quadrant-no">5</div>
          <input
            type="text"
            placeholder="Reward Title (Max 2 Words)"
            v-model="reward.reward_five"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="coupon.coupon_five"
          />
        </div>
        <div class="input-group" v-if="isQuadrantSelect">
          <div class="quadrant-no">6</div>
          <input
            type="text"
            placeholder="Reward Title (Max 2 Words)"
            v-model="reward.reward_six"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="coupon.coupon_six"
          />
        </div>
      </div>
      <div class="reward-input-section" v-if="isQuadrantSelect">
        <div class="input-group" :class="isQuadrantSelect ? 'odd-section' : ''">
          <div class="quadrant-no">7</div>
          <input
            type="text"
            placeholder="Reward Title (Max 2 Words)"
            v-model="reward.reward_seven"
          />
          <input
            type="text"
            placeholder="Coupon Code Here"
            v-model="coupon.coupon_seven"
          />
        </div>
      </div>
    </div>
    <div class="footer-section">
      <div class="preview-btn" @click="previewCamp">Preview</div>
      <div class="cancel-btn" @click="this.$router.push({ name: 'spin' })">
        Cancel
      </div>
      <div class="create-btn" @click="checkStatus(this.status)">Create</div>
    </div>
  </div>
  <Loader v-if="isLoading" />
  <PreviewCampaign
    v-if="isPreview"
    @close="closePreview"
    :imageUrl="previewImageUrl"
  />
</template>

<script>
import axios from "axios";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import { base_url, trivialy_upgrade_url } from "../../../../config.js";
import Loader from "../../Shared/AdminLoaderComponent.vue";
import PreviewCampaign from "../../Shared/PreviewCampaign.vue";
export default {
  mounted() {
    this.fetchUserData();
    // console.log(base_url);
  },
  data() {
    return {
      previewImageUrl: wpApiSettings.imagePath + "/previewCampaign/spin.png",
      isPreview: false,
      isLoading: false,
      isQuadrantSelect: false,
      select_quadrant: 0,
      userData: [],
      title: "",
      reward: {
        reward_one: "",
        reward_one: "",
        reward_two: "",
        reward_three: "",
        reward_four: "",
        reward_five: "",
        reward_six: "",
        reward_seven: "",
      },
      coupon: {
        coupon_one: "",
        coupon_two: "",
        coupon_three: "",
        coupon_four: "",
        coupon_five: "",
        coupon_six: "",
        coupon_seven: "",
      },
      popup_time: "Select Popup Timing",
      campaign_time: "Select Campaign Time",
      status: 1,
      link: "",
      isNotTwoWords: false,
      subscriptionStatus: false,
      spinCount: 0,
      wp_email: "",
    };
  },
  components: {
    Loader,
    PreviewCampaign,
  },

  methods: {
    previewCamp() {
      this.isPreview = true;
    },
    closePreview() {
      this.isPreview = false;
    },
    fetchAllSpinData() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/get-all-spin-quiz-data", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          // Handle successful response
          this.spinCount = response.data.length;
          // console.log(this.spinData);
        })
        .catch((error) => {
          // Handle error

          this.error = "Error fetching data: " + error.message;
        });
    },
    toggleQuadrantforSeven() {
      // this.isQuadrantSelect = true;
      window.open(trivialy_upgrade_url, "_blank");

      this.isQuadrantSelect = false;
    },
    toggleQuadrantforFive() {
      this.isQuadrantSelect = false;
    },
    fetchUserData() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/user-data", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          // Handle successful response
          this.userData = response.data;
          this.wp_email = response.data.user_email;
          this.fetchAllSpinData();

          this.isLoading = false;
          // console.log(this.spinData);
        })
        .catch((error) => {
          // Handle error

          this.error = "Error fetching data: " + error.message;
        });
    },
    checkStatus() {
      this.isLoading = true;
      axios
        .get(wpApiSettings.root + "custom/v1/check-live-status", {
          headers: {
            "X-WP-Nonce": wpApiSettings.nonce,
          },
        })
        .then((response) => {
          if (response.data.success == true) {
            this.status = 2;
            this.createSpinQuadrant(this.status);
          } else {
            this.createSpinQuadrant(this.status);
          }
        })
        .catch((error) => {
          this.isLoading = false;
          this.error = "Error fetching data: " + error.message;
        });
    },
    getCurrentTime() {
      var currentDate = new Date();

      var formattedDate = currentDate.toISOString().split("T")[0];
      var formattedTime =
        ("0" + currentDate.getHours()).slice(-2) +
        ":" +
        ("0" + currentDate.getMinutes()).slice(-2) +
        ":" +
        ("0" + currentDate.getSeconds()).slice(-2);

      var currentTime = formattedDate + " " + formattedTime;

      return currentTime;
    },
    createSpinQuadrant(status) {
      var currentDate = this.getCurrentTime();
      if (this.isQuadrantSelect == true) {
        this.select_quadrant = 2;
      } else if (this.isQuadrantSelect == false) {
        this.select_quadrant = 1;
      }
      this.isNotTwoWords = this.checkTwoWord(this.reward);
      // console.log(this.isNotTwoWords);
      if (this.isNotTwoWords) {
        this.isLoading = false;
        toast.error("One of the Reward is More than Two Words", {
          position: toast.POSITION.BOTTOM_RIGHT,
        });
      } else {
        const spinData = {
          title: this.title,
          select_quadrant: this.select_quadrant,
          reward: this.reward,
          coupon: this.coupon,
          popup_time: this.popup_time,
          campaign_time: this.campaign_time,
          live_status: status,
          time: currentDate,
          link: this.link,
        };

        let quadrant_string = "";

        if (this.select_quadrant == 1) {
          quadrant_string = "5 Quadrant";
        } else if (this.select_quadrant == 2) {
          quadrant_string = "7 Quadrant";
        }
        const superAdminData = {
          user: this.userData.user_name,
          email: this.userData.user_email,
          spin_name: this.title,
          spin_quadrant: quadrant_string,
          status: spinData.live_status,
        };

        axios
          .post(
            wpApiSettings.root + "custom/v1/save-spin-quiz-data",
            spinData,
            {
              headers: {
                "X-WP-Nonce": wpApiSettings.nonce,
              },
            }
          )
          .then((response) => {
            if (response.status == 400) {
              this.isLoading = false;
              toast.error("Something Went Wrong", {
                position: toast.POSITION.BOTTOM_RIGHT,
              });
            } else {
              axios
                .post(base_url + "spin", superAdminData)
                .then((response) => {
                  this.isLoading = false;
                  if (status == 2) {
                    this.$router.push({
                      name: "spin",
                      query: { showPendingToast: true },
                    });
                  } else {
                    this.$router.push({ name: "spin" });
                  }
                })
                .catch((error) => {
                  toast.error("Something Went Wrong", {
                    position: toast.POSITION.BOTTOM_RIGHT,
                  });
                  this.isLoading = false;
                  this.error = "Error fetching data: " + error.message;
                });
            }
          })
          .catch((error) => {
            this.isLoading = false;
            toast.error("Please Fill All Section", {
              position: toast.POSITION.BOTTOM_RIGHT,
            });
            this.error = "Error fetching data: " + error.message;
          });
      }
    },

    checkTwoWord(data) {
      if (data.reward_one != "") {
        const words = data.reward_one.split(/\s+/);

        if (words.length > 2) {
          return true;
        }
      } else if (data.reward_two != "") {
        const words = data.reward_two.split(/\s+/);
        if (words.length > 2) {
          return true;
        }
      } else if (data.reward_three != "") {
        const words = data.reward_three.split(/\s+/);
        if (words.length > 2) {
          return true;
        }
      } else if (data.reward_four != "") {
        const words = data.reward_four.split(/\s+/);
        if (words.length > 2) {
          return true;
        }
      } else if (data.reward_five != "") {
        const words = data.reward_five.split(/\s+/);
        if (words.length > 2) {
          return true;
        }
      } else if (data.reward_six != "") {
        const words = data.reward_six.split(/\s+/);
        if (words.length > 2) {
          return true;
        }
      } else if (data.reward_seven != "") {
        const words = data.reward_seven.split(/\s+/);
        if (words.length > 2) {
          return true;
        }
      } else {
        return false;
      }
    },
  },
};
</script>

<style scoped>
.preview-btn {
  padding: 18px 22px;
  width: 120px;
  height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #706aea;
  border-radius: 8px;
  background-color: transparent;
  cursor: pointer;

  color: var(--status-error, #706aea);
  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}
.custom-input {
  width: 100% !important;
}
.custom-group {
  width: 100%;
}
.custom-group select {
  width: 100%;
  padding: 16px 24px; /* Optional: Add padding for better appearance */
  max-width: inherit;
  border-radius: 12px;
  border: 1px solid #e3e3e3;

  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%;
}
.form-in-line {
  display: flex;
  gap: 16px;
}
.odd-section {
  width: 49% !important;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.quadrant-no {
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #a0a0a0;
  padding: 16px 24px;
  border-radius: 12px;

  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-family: "Inter", sans-serif;
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 23.4px */
}
.input-group {
  display: flex;
  gap: 16px;
  width: 100%;
}

.input-group input {
  width: 50%;
  border: 1px solid #e3e3e3;
  border-radius: 12px;
  padding: 0px 24px;

  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Link/Link 2 | Active | Medium 500 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%; /* 22.4px */
}

.title-input {
  width: 100%;

  border: 1px solid #e3e3e3;
  border-radius: 12px;
  padding: 16px 24px;

  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Link/Link 2 | Active | Medium 500 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 140%; /* 22.4px */
}
.reward-input-section {
  display: flex;
  width: 100%;
  gap: 16px;
}

.reward-input-section-body {
  display: flex;
  flex-direction: column;
  gap: 16px;
  width: 100%;
}

.reward-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
.spin-header {
  display: flex;
  align-items: center;
  gap: 8px;
  color: var(--color-text-colors-900-black-high-emp, #181a17);
  /* Text/H1-H6/H6 | Subtitle | Bold 700 */
  font-family: "Inter", sans-serif;
  font-size: 24px;
  font-style: normal;
  font-weight: 700;
  line-height: 120%; /* 28.8px */
}

.spin-wrap {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.quadrant-body {
  position: relative;
  margin-top: 16px;
  background-color: #ffffff;
  padding: 16px 24px;
  border-radius: 12px;
  cursor: pointer;
}
.quadrant-header {
  color: var(--color-text-colors-700-black-medium-emp, #2f2f2f);
  /* Text/Body/Body 3 | Light | Regular 400 */
  font-family: "Inter", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 400;
  line-height: 140%; /* 22.4px */
}
.spin-quadrants {
  display: flex;
  gap: 24px;
}
.tick-sign {
  position: absolute;
  left: 80%;
}

.footer-section {
  margin-top: 8px;
  display: flex;
  justify-content: end;
  gap: 8px;
}
.cancel-btn {
  padding: 18px 22px;
  width: 120px;
  height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #f55151;
  border-radius: 8px;
  background-color: transparent;
  cursor: pointer;

  color: var(--status-error, #f55151);
  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}

.create-btn {
  padding: 18px 22px;
  width: 120px;
  height: 48px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 8px;
  background-color: #706aea;
  cursor: pointer;

  color: var(--color-natural-50, #fff);

  text-align: center;
  /* Text/Body/Body 4 | Bold | Semibold 600 */
  font-family: "Inter", sans-serif;
  font-size: 14px;
  font-style: normal;
  font-weight: 600;
  line-height: 130%; /* 18.2px */
}
</style>
