#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include "SkyeTekAPI.h"
#include "SkyeTekProtocol.h"
#include <curl/curl.h>

int main(int argc, char* argv[])
{

	//RFID initialization
	LPSKYETEK_DEVICE *devices = NULL;
	LPSKYETEK_READER *readers = NULL;
	LPSKYETEK_TAG *tags = NULL;
	SKYETEK_STATUS status;
	unsigned short count = 0;
	int numDevices = 0;
	int numReaders = 0;
	const int delay = 400000;  	//wait at least 400ms after closing the interface before re-opening (USB enumeration)
	const int tests = 3; 		//number of open/close tests to perform
	const int iterations = 10; 	//number of select tag operations to perform for each test
	int failures = 0;
	int total = 0;
	char discover[50];

	//Curl initialization
	CURL *curl;
  	CURLcode res;
  	/* In windows, this will init the winsock stuff */ 
 	 curl_global_init(CURL_GLOBAL_ALL);

	for(int m = 0; m < tests; m++)
	{
		total ++;
		printf("\n\nTEST #%d\n", total);

		//Scanning for USB device that might have a reader
		if((numDevices = SkyeTek_DiscoverDevices(&devices)) > 0)
		{
			//Scanning for readers on previewsly detgected USB device
			if((numReaders = SkyeTek_DiscoverReaders(devices,numDevices,&readers)) > 0 )
			{

				printf("Scanning for tags !");
				while(1){
					for(int i = 0; i < numReaders; i++)
					{
						//printing readers found for each iteration (debug)
						printf("Reader Found: %s-%s-%s\n", readers[i]->manufacturer, readers[i]->model, readers[i]->firmware);
						//system("aplay rd.wav");
						for(int k = 0; k < iterations; k++)
						{
							//printf("\tIteration = %d\n",k);
							//counting tags on given reader device
							status = SkyeTek_GetTags(readers[0], AUTO_DETECT, &tags, &count);
							if(status == SKYETEK_SUCCESS)
							{
								if(count == 0)
								{
									//printf("\t\tNo tags found\n");
								}
								else
								{
									for(int j = 0; j < count; j++)
									{
										//printing previously found tags on the screen
										//system("aplay rd.wav"); //sound notification !!
										printf("\t\tTag Found: %s-%s\n", SkyeTek_GetTagTypeNameFromType(tags[j]->type), tags[j]->friendly);
										sprintf(discover,"id=%s",tags[j]->friendly);
										printf("%s", discover);
										/* get a curl handle */ 
										curl = curl_easy_init();
										if(curl) {
											curl_easy_setopt(curl, CURLOPT_URL, "http://217.199.187.59/francoisle.fr/wdidy/FManager/tag.php");
											curl_easy_setopt(curl, CURLOPT_POSTFIELDS, discover);
											res = curl_easy_perform(curl);
											if(res != CURLE_OK){
											  fprintf(stderr, "curl_easy_perform() failed: %s\n",curl_easy_strerror(res));
											}
											curl_easy_cleanup(curl);
										}
										curl_global_cleanup();
									}
								}
							}
							else
							{
								printf("ERROR: GetTags failed\n");
							}
						}
						SkyeTek_FreeTags(readers[i],tags,count);
					}
				}
			}
			else
			{
				failures ++;
				printf("failures = %d/%d\n", failures, total);
				printf("ERROR: No readers found\n");
			}		
		}
		else
		{
			failures ++;
			printf("failures = %d/%d\n", failures, total);
			printf("ERROR: No devices found\n");
		}
		SkyeTek_FreeDevices(devices,numDevices);
		SkyeTek_FreeReaders(readers,numReaders);
		usleep(delay);
	}
}
